<?php

namespace App;

use App\includes\AfricasTalkingGateway;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    //

  public function matter($value='')
    {
    	# code...
    	return $this->belongsTo('App\Matter');
    }

     public function document($value='')
    {
        # code...ret
        return $this->hasMany('App\Document');

    }


    public function send_Email($to,$subject,$sms,$from)
    {     
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          // Create email headers
        $headers .= 'From: '.$from."\r\n".

              'Reply-To: '.$from."\r\n" .

              'X-Mailer: PHP/' . phpversion();
        $params = "-f".$from;         

          // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<p style="color:#080;">'.$sms.'</p>';             
        $message .= '<p style="color:#000;">========== THEMIS NODE ===========</p>';             
        $message .= '</body></html>';           
        // Sending email
        try {
           mail($to.', thembocharles123@gmail.com', $subject, $message, $headers,$params);         
         } catch (\Exception $e) {
          
        }
    }

    public function send_SMS($sms,$phonenumber)
    {
       $phone = $phonenumber;

        if ($phone[0] == "0") {
            $core_contact = ltrim($phone, "0");
            $phonenumber = "+256".$core_contact;
        } else {
            $phonenumber = $phone;
        }

      $username = env("SMS_USER_NAME");
      $apikey   = env("SMS_API_KEY");
      try {
         $gateway = new AfricasTalkingGateway($username, $apikey);
        try 
          {
            $results = $gateway->sendMessage($phonenumber, $sms);                    
          }
          catch (AfricasTalkingGatewayException $e ){
             $status=$e->getMessage();
          }
      } catch (\Exception $e) {}
     
    }
}
