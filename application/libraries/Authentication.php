<?php 
    class Authentication 
    {
        public function isAuthorizeMember($currentUserLevel)
        {
            if($currentUserLevel == 'member' || $currentUserLevel == 'admin' )            
                {return true;}
            else
                {return false;}
            
        }
        
        public function isAuthorizeAdmin($currentUserLevel)
        {
            if($currentUserLevel == 'admin' )            
                {return true;}
            else
                {return false;}
        }
    }
?>