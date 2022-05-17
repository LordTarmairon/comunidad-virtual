<?php
    Class ZoomModel extends Model{
        function __construct(){
            parent::__construct();
        }

        public function is_table_empty() {
            $query = $this->db->connect()->prepare("SELECT id FROM zoom_oauth WHERE provider = 'zoom'");
            if($result->num_rows) {
                return false;
            }
      
            return true;
        }
      
        public function get_access_token() {
            $sql =  $query = $this->db->connect()->prepare("SELECT provider_value FROM zoom_oauth WHERE provider = 'zoom'");
            $result = $sql->fetch_assoc();
            return json_decode($result['provider_value']);
        }
      
        public function get_refersh_token() {
            $result = $this->get_access_token();
            return $result->refresh_token;
        }
      
        public function update_access_token($token) {
            if($this->is_table_empty()) {
                $this->db->connect()->prepare("INSERT INTO zoom_oauth(provider, provider_value) VALUES('zoom', '$token')");
            } else {
                $this->db->connect()->prepare("UPDATE zoom_oauth SET provider_value = '$token' WHERE provider = 'zoom'");
            }
        }

        
        try {
            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
          
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $_GET['code'],
                    "redirect_uri" => REDIRECT_URI
                ],
            ]);
          
            $token = json_decode($response->getBody()->getContents(), true);
          
            $db = new DB();
            $db->update_access_token(json_encode($token));
            echo "Access token inserted successfully.";
        } catch(Exception $e) {
            echo $e->getMessage();
        }

    }
?>