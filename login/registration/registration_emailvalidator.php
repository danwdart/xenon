<?php
/* --- Validation of a email address ----------------------------------------------- Validation of a email address --- *\
| Contains three methods of validating email addresses                                                                  |
| 1.Validate the string given as an email address to make sure it matches the form name@domainname                      |
| 2.Validate the DNS MX record that the domain exists and has valid MX records.                                         |
| 3.Validate the MX records have valid email servers that a mail connection can be made on.                             |
\* --- Validation of a email address ----------------------------------------------- Validation of a email address --- */

// Set us up the class 
class EmailValidator
{ 
  // Set us up the class variables 
  private $email; 

  // 1.Validate the string given as an email address to make sure it matches the form name@domainname 
  private function checkEmailstring( $email )
  { 
    if ( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email ) )
    { 
      return false; 
    } 
    return true; 
  }
   
  // 2.Validate the DNS MX record that the domain exists and has valid MX records. 
  private function checkEmaildns( $email )
  { 
    if ( preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email ) )
    { 
      list( $username, $domain) = split( '@', $email ); 
      if ( !checkdnsrr( $domain,'MX' ) )
      { 
        return false; 
      }
      else
      { 
        return true; 
      } 
    } 
    else
    { 
      return false; 
    } 
  } 

  // 3.Validate the MX records have valid email servers that a mail connection can be made on. 
  private function checkEmailserver( $email )
  { 
    if ( preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email ) )
    { 
      list( $username, $domain ) = split( '@', $email ); 
      $mxhosts = array(); 
      if( !getmxrr( $domain, $mxhosts ) )
      { 
        if ( !fsockopen( $domain, 25, $errno, $errstr, 30 ) )
        { 
          return false; 
        } 
        else
        { 
          return true; 
        } 
      } 
      else
      { 
        foreach ( $mxhosts as $host )
        { 
          if ( fsockopen( $host, 25, $errno, $errstr, 30 ) )
          { 
            return true; 
          } 
        } 
        return false; 
      } 
    } 
  }
  
  // Validates the specified email address 
  public function validate( $email )
  {
    $format = $this->checkEmailstring( $email ); 
    if ( $format == true )
    {
      $dnscheck = $this->checkEmaildns( $email ); 
      if ( $dnscheck == true )
      { 
        $emailserver = $this->checkEmailserver( $email ); 
        if ( $emailserver == true )
        {
          // Valid email address
          return true;
        }
      }
    }
    
    // Invalid email address
    return false;
  }
}
?> 