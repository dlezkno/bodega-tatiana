<?php



class Connect {
	
	/**
     * Pass the connection data
     */
     
	public function init(){
		//$this->connectDB("10.60.60.43","digilab_hecho","d73prh8","webforms");
        $con = mysqli_connect("localhost","root","");  
		if (mysqli_connect_errno($con)){
			return('{status:"failed",message:"'. mysqli_connect_error().'"}');
	    }else{
	    	mysqli_select_db($con,"bodega");
	    	return($con);
	    }
	}	 
}













?>