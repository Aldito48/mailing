<?php
    function sendWA ($gateway, $token, $apiURL, $phone, $message) {
        if ($gateway == 'Wablas') {
            $curl = curl_init();

            $data = [
                'phone' => $phone,
                'message' => $message,
            ];

            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                )
            );
            curl_setopt($curl, CURLOPT_URL, $apiURL."/send-message");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_exec($curl);
            curl_close($curl);
        } else if ($gateway == 'Fonnte') {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $apiURL.'/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $phone,
                    'message' => $message,
                    'typing' => false,
                    'delay' => '2',
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: '.$token
                ),
            ));
            curl_exec($curl);
            curl_close($curl);
        }

        return;
    }
?>