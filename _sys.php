<?php
 /*
  filename: _sys.php
  author:	ya251j@innovking
  des:
	- 
  dates
	creation:	11/01/2026 17:43:20
	modified:	11/02/2026 08:55:00
	completed:	--/--/2026 @ 
 */
 
 //
  //system build
   if(!class_exists('tem')){//if the operational codebase hasn't been created
    class tem{//tem class
	 //variables
	  protected $__defaults=array(//defaults
	   'language'=>'en',
	   'country'=> 'us',  'timezone'=> 'America/New_York',
	   'javascript'=> 1,
	   '_db'=>array(
	    'host'=>null, 'base'=>null,
		'user'=>null, 'pass'=>null
	   )
	  );
	  protected $__info=array(//info
	   'errors'=>array( 'bank'=>array(), 'ids'=>array() ),//errors
	   'database'=>array(//database
	    '_current'=>null,'sql'=>null
	   )
	  );
	  protected $_rsrc=array(//resources
	   '_streams'=>array( 'sql'=>array() ),//database connections
	   '_locs'=>array(
	    'lang_dir'=>'_rsrc/_lngs/'
	   ),
	   'language'=>null,//selected language
	   '_lang'=>array( ),//language bank
	   
	   'country'=>null, 'timezone'=>null,
	  );
	  public $_sql=null;//sql stream
	  //language
	   public $_langu=null;//selected language
	   public $_lang=null;//language reference
	  
	 //functions
	  //_output: output parser handler
	   protected function _oupt($__ap){
	    //values
	     $output=null; $_oupt=null; $_output=null;//output placeholder
		 $u_ouput=($__ap['output']) ?? ($__ap['text']) ?? null;//user provided output
		 $mode=($__ap['direction']) ?? ($__ap['mode']) ?? null;//output mode
		 $o_type=($__ap['type']) ?? ($__ap['output type']) ?? ($__ap['output_type']) ?? null;//output type
		 $_return=($__ap['return']) ?? ($__ap['rtn']) ?? false;//return specifier
		 $r_type=($__ap['return type']) ?? ($__ap['return_type']) ?? null;//return type
		//
		 if($mode=='set' || $_mode=='setting'){
		  if($o_type=='error'){
		   //variable
			//error information
			 $e_form=($__ap['form']) ?? ($__ap['error form']) ?? ($__ap['error_form']) ?? ($__ap['error type']) ?? ($__ap['error_type']) ?? false;//error form (type)
			 $e_code=($__ap['code']) ?? ($__ap['error code']) ?? ($__ap['error_code']) ?? false;//error code
			 $e_id=($__ap['id']) ?? ($__ap['error id']) ?? ($__ap['error_id']) ?? $this->_miscu(array( 'obj'=>'random', 'type'=>'id' ));//error id
			 $e_msg=($__ap['message']) ?? ($__ap['msg']) ?? ($__ap['error message']) ?? ($__ap['error_message']) ?? ($__ap['error_msg']) ?? ($__ap['error msg']) ?? false;//error message
			$_info=array( 'is_error'=>true, 'error_form'=>$e_form, 'error_code'=>$e_code, 'id'=>$e_id, 'message'=>$e_msg );
		   //
			//output build
			 if(!($_return===false)){//if a specific return was asked for
			  //sets the output
			   if($_return=='is_error'||$_return=='is error'){ $_output=$_info['is_error']; }//is_error flag
			   elseif($_return=='form'||$_return=='type'||$_return=='error form'||$_return=='error_form'||$_return=='error type'||$_return=='error_type'){ $_output=$_info['error_form']; }//error form (type)
			   elseif($_return=='code'||$_return=='error code'||$_return=='error_code'){ $_output=$_info['error_code']; }//error code
			   elseif($_return=='id'||$_return=='error id'||$_return=='error_id'){ $_output=$_info['id']; }//error id
			   elseif($_return=='message'||$_return=='msg'||$_return=='error message'||$_return=='error_message'||$_return=='error msg'||$_return=='error_msg'){ $_output=$_info['message']; }//error message
			  $output=$_output;//output shift
			 }
			 else{ $output=($r_type=='string'||$r_type==1||$r_type=='plaintext') ? $_info['message'] : $_info; }//defaults to plaintext the message or provides the error array
		  }
		  else{
		  }
		 }
		 elseif($_mode='get' || $_mode=='getting'){
		  if($o_type=='error'){
		  }
		  else{
		  }
		 }
	     
		 else{ $output=$u_output; }
		 return $output;//returns the error as an array
	   }
	  //_dbase: database function
	   protected function _dbase($__ap){
		//values
	     $output=null; $_output=null;$_oupt=null;//output
		 $obj=($__ap['obj']) ?? ($__ap['objective']) ?? false;//objective
		 $_return=($__ap['return']) ?? false;
		 //connection info
		  $ci_host=($__ap['host']) ?? ($__ap['server']) ?? ($__ap['host server']) ?? ($__ap['host_server']) ?? ($this->__defaults['_db']['host']);//database connection host info
		  $ci_user=($__ap['user']) ?? ($__ap['username']) ?? ($this->__defaults['_db']['user']);//database connection user info
		  $ci_pass=($__ap['pass']) ?? ($__ap['password']) ?? ($this->__defaults['_db']['pass']);//database connection password info
		  $ci_base=($__ap['base']) ?? ($__ap['database']) ?? ($this->__defaults['_db']['base']);//database connection database 'datapool' info
		//
		 try{
	      if(!empty($obj)){//checks the objective
		   if($obj=='+connect'){//simple connect
		    $i_conn=array( 'host'=>$ci_host, 'user'=>$ci_user, 'paas'=>$ci_pass, 'base'=>$ci_base );//connection information
		    $_conn=new mysqli($ci_host, $ci_user, $ci_pass, $ci_base);//builds a new mysqli connection
			//connection information storage
			 $this->__info['database']['sql'][$i_conn['base']]=$i_conn;//stores the variable (as reference)
			 //determines if it should be the flag it as the current stream
			  if(empty($this->__info['database']['_current'])){ $this->__info['database']['_current']=$i_conn['base']; }
			return$_conn;//returns the connection object
		   }
		  }
		 }
		   catch(Exception $ex_c){ /* $_output=$exc->getMessage(); */ //sets the error message for output
		    $this->_err(array( 'obj'=>'store', 'error_form'=>'exception', 'error_code'=>$ex_code,//stores the error
		     'error_id'=>$this->_miscu(array( 'obj'=>'random', 'type'=>'id' )), 'error_message'=>$exc->getMessage()
		    ));
		   }
		  finally{ if(!empty($_output)){ $output=$_output; }else{ $output=$_oupt; } return$output; }//output transfer
	   }
	  //err: error handler
	   protected function _err($__ap){
	    //values
	     $output=null; $_output=null;$_oupt=null;//output
		 $obj=($__ap['obj']) ?? ($__ap['objective']) ?? false;//objective
		 $_return=($__ap['return']) ?? false;
		 //error specific
		  $er_is=($__ap['is_error']) ?? ($__ap['is error']) ?? null;//is_error flag
		  $er_id=($__ap['id']) ?? ($__ap['error id']) ?? ($__ap['error_id']) ?? null;//error id
		  $er_code=($__ap['code']) ?? ($__ap['error code']) ?? ($__ap['error_code']) ?? null;//error code
		  $er_form=($__ap['form']) ?? ($__ap['error form']) ?? ($__ap['error_form']) ?? null;//error form
		  $er_msg=($__ap['message']) ?? ($__ap['msg']) ?? ($__ap['error message']) ?? ($__ap['error_message']) ?? ($__ap['error msg']) ?? ($__ap['error_msg']) ?? null;//error message
	     $error_bank=& $this->__info['errors']['bank'];//error bank
	     $error_ids=& $this->__info['errors']['ids'];//error ids
	    //
	     try{//error container (irony)
		  if(($obj===false)){ throw new Exception('error while erroring'); }//invalid (false) objective
		  else{//checks the objective
		   if($obj=='create'||$obj=='set'||$obj=='store'){//stores an error
		    //creates the error array
		     $er_a=$this->_oupt(array( 'mode'=>'set', 'type'=>'error',
			  'id'=>$er_id, 'code'=>$er_code, 'form'=>$er_form, 'message'=>$er_msg
		 	 ));
		    //stores the error
		     $error_bank[]=$er_a;//storage
			 if($error_bank[((count($error_bank))-1)]['id']==$er_id){//storage check
			  $error_ids[$er_id]=((count($error_bank))-1);//stores the error id location
			  if( ($error_bank[$error_ids[$er_id]]['id']===$er_id) ){ $_oupt=true; }else{ $_oupt='-2'; }
			 } else { $_oupt='-1'; }
		   }
		   elseif($obj=='get'||$obj=='retrive'||$obj=='retrival'||$obj=='find'){//pulls error information
		    $e_exists=(in_array($er_id,array_keys($error_bank))||$error_bank[$error_ids[$er_id]]['id']==$error_id) ? true : false;//checks if the error exists
		    //acts according to the error existence
		     if($e_exists===true){ $_oupt=$error_bank[$error_ids[$er_id]]; }//gets the error info //if the error exists
		 	 else{ $_oupt='-1'; }//returns -1 if error doesn't exists
		   }
		  }
		 }
		  catch(Exception $ex_c){ $_output=$exc->getMessage(); }//sets the error message for output
		  finally{ if(!empty($_output)){ $output=$_output; }else{ $output=$_oupt; } return$output; }//output transfer
	   }
	  //_file: files handler
	   protected function _file($__ap){
	    //values
		 $output=null;//output
		 $__files=($__ap['files']) ?? ($__ap['file']) ?? $_FILES; $_files=$_FILES;//files array
		 $m_size=999999999;//max file size
		 $r_type=($__ap['return_type']) ?? ($__ap['return type']) ?? null;//return type
		 $obj=($__ap['obj']) ?? ($__ap['objective']) ?? null;//objective
		 $dir=($__ap['dir']) ?? ($__ap['directory']) ?? null;//directory
		 $dirs=($__ap['dirs']) ?? ($__ap['directorys']) ?? ($__ap['directories']) ?? null;//directories
		 $dir_div=($__ap['directory divider']) ?? ($__ap['directory_divider']) ?? ($__ap['divider']) ?? '/';//directory divider
		 $filenames=($__ap['filenames']) ?? ($__ap['filename']) ?? null;//filename(s)
		 $filetypes=($__ap['filetypes']) ?? ($__ap['filetype']) ?? ($__ap['file type']) ?? ($__ap['file types']) ?? ($__ap['file_type']) ?? ($__ap['file_types']) ?? ($__ap['type']) ?? ($__ap['types']) ?? null;//filetype(s)
		 $file_exts=($__ap['ext']) ?? ($__ap['extension']) ?? ($__ap['file ext']) ?? ($__ap['file_ext']) ?? ($__ap['file extension']) ?? ($__ap['file_extension']) ?? ($__ap['ext']) ?? ($__ap['extension']) ?? null;//file extension
		  $file_exts_div=($__ap['ext div']) ?? ($__ap['ext divider']) ?? ($__ap['extension div']) ?? ($__ap['extension divider']) ?? ($__ap['ext_div']) ?? ($__ap['ext_divider']) ?? ($__ap['extension_div']) ?? ($__ap['extension_divider']) ?? ',';
		 $_multi=($__ap['multi']) ?? ($__ap['multiple']) ?? null;//multiple flag
		 $_skip=($__ap['skip']) ?? ($__ap['skip list']) ?? ($__ap['skip_list']) ?? null;//skip list
		 $_size=($__ap['size']) ?? ($__ap['max size']) ?? ($__ap['max_size']) ?? null;//max size
		 $sz_disallowed=($__ap['disallowed size']) ?? ($__ap['disallow size']) ?? ($__ap['disallowed_size']) ?? ($__ap['disallow_size']) ?? null;//disallowed size
		  //$sz_allowed=($__ap['allowed size']) ?? ($__ap['allow size']) ?? ($__ap['allowed_size']) ?? ($__ap['allow_size']) ?? null;//allowed size
		  //$ex_allowed=($__ap['allowed extension']) ?? ($__ap['allow extension']) ?? ($__ap['allowed_extension']) ?? ($__ap['allow_extension']) ?? ($__ap['allowed ext']) ?? ($__ap['allow ext']) ?? ($__ap['allowed_ext']) ?? ($__ap['allow_ext']) ?? null;//allowed file types
		 $ex_disallowed=($__ap['disallowed extensions']) ?? ($__ap['disallow extensions']) ?? ($__ap['disallowed_extensions']) ?? ($__ap['disallow_extensions']) ?? ($__ap['disallowed extension']) ?? ($__ap['disallow extension']) ?? ($__ap['disallowed_extension']) ?? ($__ap['disallow_extension']) ?? ($__ap['disallowed ext']) ?? ($__ap['disallow ext']) ?? ($__ap['disallowed_ext']) ?? ($__ap['disallow_ext']) ?? null;;//disallowed file extension
		 $ty_disallowed=($__ap['disallowed type']) ?? ($__ap['disallow type']) ?? ($__ap['disallowed_type']) ?? ($__ap['disallow_type']) ?? null;;//disallowed file types
		 $d_dir='/';//default directory
		 $f_arr=array( 'name', 'full_path', 'type', 'tmp_name', 'error', 'size' );
		//
		  if(!empty($obj)){
		   //
		    //directory
		     if($obj=='directory check'||$obj=='directory_check'||$obj=='dir_check'||$obj=='dir check'||$obj=='check'){//directory check
			  //values
			   $d_ex=0;//directory exists flag
			   $ch_type=($__ap['check']) ?? ($__ap['check_type']) ?? ($__ap['check type']) ?? 0;//determines the check type
			   $prot=($__ap['protocol']) ?? ($__ap['proto']) ?? ':/';//protocol values
			  //
			   $c_dir=(!empty($dir)) ? $this->_file(array( 'obj'=>'directory_convert', 'dir'=>$dir )) : null;//cleans the directory value
			   //
			    if(!empty($filenames)){//checks if a directory is included in the filename
				 //checks the check type
				  if($ch_type==1){//searches for a directory divider within
				   //
				    $d_cnt=0; $d_pos=array(); $d_idx=array();//directory count and position
				   //
				    if(is_array($filenames)){
					 foreach($filenames as$fi=>$fv){//loops through the filenames
					  $srh=array( 'index'=>null, 'value'=>null );//search
					  //
					   //index
					    if(is_array($fi)){
						}
						else{
						 $sh_fn=strpos($fi,$dir_div);
						 $srh['index']=($sh_fn>=1||($sh_fn===0)==true) ? $sh_fn : null;
						}
					   //value
					    if(is_array($fv)){//if the filename is an array
					    }
					    else{//if the filename isn't an array
						 $sh_fn=strpos($fv,$dir_div);
						 $srh['value']=($sh_fn>=1||($sh_fn===0)==true) ? $sh_fn : null;
					    }
					  //
					   if((($srh['index']===null)!=true)&&(($srh['value']===null)!=true)){
						$d_cnt++;//increase the directory count
						//position increase
						 $d_pos[$fi]=$srh['value'];
						 $d_idx[$fi]=$srh['index'];
					   }
					 }
					 //output
					  if($r_type=='position'){ }
					  else{ $d_ex=$d_cnt; }
				    }
				    else{
				    }
				  }
				  else{//default - see if an explicit directory exists
				   if(is_array($filenames)){//filename
				   if(isset($filenames[((string)$dir)])||!empty((string)$dir)){ $d_ex=1; }
				   elseif((isset($filenames['dir'])||!empty($filenames['dir']))||(isset($filenames['directory'])||!empty($filenames['directory']))){ $d_ex=1; }
				  }
				 }
				}
				elseif(!empty($dir)){//checks the directory
				 //
				  if($ch_type==2){//checks for a protocol divider
				   //
				    //protcol check
				     $opsh=((strpos($filenames,$prot)>=1)||(strpos($filenames,$prot)===0)) ? strpos($filenames,$prot) : null;
					 $opsh2=((($opsh===null)==false)&&($filenames[$opsh+1])) ? 1 : null;
				    $pr_sh=((($opsh===null)==false)&&(($opsh2===null)==false)) ? true : false;
				   //return
				    if($r_type=='number'||$r_type=='num'){ $d_ex=$opsh2; }
					else{ $d_ex=$pr_sh; }
				  }
				   elseif($ch_type==3){ $d_ex=true; }
				  else{//checks for a directory divider
				   if(!empty($dir_div)){
					//checks if there is a leading directory divider
				     //if(!is_array($dir)){ $dir=($dir[0]!=$dir_div) ? $dir_div.$dir : $dir; }
				     //elseif(!empty($dir)){ $dir=(($dir[0]!=$dir_div&&$dir[((array_keys($dir))[0])]!=$dir_div) ) ? array_merge(array($dir_div), $dir) : $dir; }
				    //searches the directory for the divider
				     if(!is_array($dir)){ $d_srh=strpos($dir,$dir_div); }
					 elseif(!empty($dir)){ $d_srh=( (isset($dir[$dir_div])||!empty($dir[$dir_div])) ) ? 0 : -1; }//
				    //search results checking
				     $d_ex=($d_srh>=1||($d_srh===0)==true) ? true : false;
				   } else{ $d_ex=false; }
				  }
				}
				else{ $d_ex=false; }//default
			   //ouput
			    $output=$d_ex;
			 }
			 elseif($obj=='directory_convert'||$obj=='directory convert'||$obj=='dir convert'||$obj=='dir_convert'||$obj=='convert'){//directory convert
			  //values
			   $rev=($__ap['reverse']) ?? null;//if the return type should be reversed
			   $r_type=($__ap['return type']) ?? ($__ap['return_type']) ?? ($__ap['return']) ?? null;//return type
			   $n_dir=null;//new directory
			  //
			   //switch occures
			    if(!empty($dir)&&is_array($dir)){//if an array is provided
				 //vals
				  $nt_dir=$dir_div;//new temporary directory listing
				  //loops
				   $d_keys=array_keys($dir);//gets the array keys
				    if($rev==1){ rsort($d_keys); }//reverse the key orders
				   $d_cnt=count($dir);//counts the directory length
				 //
				  for($dc=0;$dc<$d_cnt;$dc++){//loops through the directory listing
				   $nt_dir.=$dir[$d_keys[$dc]];//adds the directory value
				   if($nt_dir[(strlen($nt_dir)-1)]!=$dir_div){ $nt_dir.=$dir_div; }
				  }
				  $output=$nt_dir;//
				}
				else{//regular
				 //vals
				  $s_len=strlen($dir);//gets the directory string length
				  $s_srh=strpos($dir,$dir_div);//searches for the directory divider
				 //
				  if(($s_srh>=1)||(($s_srh===0)==true)){//if the divider was found
				   $nt_dir=$dir_div;//new temporary directory listing
				   $dr_dv=$dir_div.$dir_div;//double lead
				   $d_split=explode($dir_div,$dir);//split the directory string
				   $ds_cnt=(is_array($d_split)) ? count($d_split) : 1;// counts the directory split
				   //loop values
				    $l_st=($rev==1) ? $ds_cnt : 0;//loop start
				    $l_ed=($rev==1) ? 0 : $ds_cnt;//loop end
					$l_cnt=0; $l_num=($rev==1) ? $l_st : $l_st;//loop counter & number
					$l_kill=0;//loop kill flag
				   //
				    do{
					 $l_cnt++; $l_num=($rev==1) ? $l_num-1 : $l_num+1;//counter and number set
					 //
					  $nt_dir.=$d_split[$l_num];
					   if($nt_dir[(strlen($nt_dir)-1)]!=$dir_div){ $nt_dir.=$dir_div; }
					 if( ($rev!=1&&$l_cnt>=$l_ed)||($l_num<=$l_ed&&$rev==1) ){ $l_kill=1; }//kill condition 
					} while($l_kill!=1&&$l_cnt<$ds_cnt);
				   //
				    $output=$nt_dir;//sets the new directory for output
				  }
				  else{//if no divider was found
				   $nt_dir=$dir_div.$dir;
					if($nt_dir[(strlen($nt_dir)-1)]!=$dir_div){ $nt_dir.=$dir_div; }
				   $output=$nt_dir;//shifts the output for display
				  }
				}
			   //output formatting
			 }
			 elseif($obj=='directory_extract'||$obj=='directory extract'||$obj=='dir_extract'||$obj=='dir extract'||$obj=='extract'){//directory extract
			 }
			//video
			 elseif($obj=='video_length'||$obj=='video length'){//video length
			 }
			//upload
			 elseif($obj=='upload'||$obj=='file_upload'||$obj=='file upload'){//file upload
			 //values
			  $u_res=null;//upload results
			  $t_upload=array();//upload info
			  $_uploads=array();//uploads placeholder
			   //file: name, full_path, type, tmp_name, error, size
			 //
			  //
			   if(!empty($__files)){//if the files are provided correctly
			    //file checker
				 //vals
				  $f_keys=(is_array($__files)) ? array_keys($__files) : array();//files loops key
				   $t_level=( (in_array('name',$f_keys)==false)&&(in_array('full_path',$f_keys)==false)&&(in_array('type',$f_keys)==false)&&(in_array('tmp_name',$f_keys)==false)&&(in_array('error',$f_keys)==false)&&(in_array('size',$f_keys)==false) ) ? 0 : 1;//determines if the file info is nested
				  $l_kill=0;//loop kill flag
				  $li_cnt=-1;//loop index counter
				  $l_cnt=0; $lp_cnt=0;//loop counter; loop max count
				   if(is_array($__files)){ $lp_cnt=($t_level==1) ? (count($__files)-5) : count($__files); }
				   else{ $lp_cnt=1; }//default to singluar count
				  $f_info=array();//file info
				  $d_focus=null;//tmp data focus
			      $_continue=null;//continue flag
				 //
				  //file info processing
				   //process the file array
					$f_list=$__files;
					foreach($f_list as$fii=>$fiv){//loops through the file array
					 //
					 //
					  if($fii=='name'||isset($fiv['name'])){//primary - uses the name as a key to retrieve all other info
					   //
					    $f_data=(isset($fiv['name'])) ? $fiv['name'] : $fiv;//sets the data source
						$fd_st=(isset($fiv['name'])) ? 'n' : 't';
					   //
					    if(is_array($f_data)){
						 foreach($f_data as$fdi=>$fdv){//loops through the form data
						  //build
						   $t_idx=null;//index
						    if($fd_st=='n'){ $t_idx=(!is_numeric($fii)) ? $fii : count($t_upload); }
							elseif($fd_st=='t'){ $t_idx=(!is_numeric($fdi)) ? $fdi : count($t_upload); }
						   $_dt=array();//data
						    $_dt['name']=(is_array($fdv)) ? -1 : $fdv;//name
						    //
							 if($fd_st=='n'){
							  $_dt['full_path']=(is_array($f_list[$fii]['full_path'][$fdi])) ? -1 : $f_list[$fii]['full_path'][$fdi];//full_path
						      $_dt['type']=(is_array($f_list[$fii]['type'][$fdi])) ? -1 : $f_list[$fii]['type'][$fdi];//type
						      $_dt['tmp_name']=(is_array($f_list[$fii]['tmp_name'][$fdi])) ? -1 : $f_list[$fii]['tmp_name'][$fdi];//tmp_name
						      $_dt['error']=(is_array($f_list[$fii]['error'][$fdi])) ? -1 : $f_list[$fii]['error'][$fdi];//error
						      $_dt['size']=(is_array($f_list[$fii]['size'][$fdi])) ? -1 : $f_list[$fii]['size'][$fdi];//size
							 }
							 elseif($fd_st=='t'){
							  $_dt['full_path']=(is_array($f_list['full_path'][$fdi])) ? -1 : $f_list['full_path'][$fdi];//full_path
						      $_dt['type']=(is_array($f_list['type'][$fdi])) ? -1 : $f_list['type'][$fdi];//type
						      $_dt['tmp_name']=(is_array($f_list['tmp_name'][$fdi])) ? -1 : $f_list['tmp_name'][$fdi];//tmp_name
						      $_dt['error']=(is_array($f_list['error'][$fdi])) ? -1 : $f_list['error'][$fdi];//error
						      $_dt['size']=(is_array($f_list['size'][$fdi])) ? -1 : $f_list['size'][$fdi];//size
							 }
						  //
						   if(!empty($_dt['name'])&&($_dt['error']!=4)){//if a filename was provided along with a non-upload error
							$t_upload[$t_idx]=$_dt;
						   }
						 }
						}
						elseif(!empty($f_data)&&is_string($f_data)){//other info
						 
						}
					  }
					  else{//nested
					  }
					}
				   //
				    //adds extra file info to the tmp upload holder
					 foreach($t_upload as$tfi=>$tfv){//loops through the upload holder
					  //
					   $fi_hand=$tfi;//index handler
					  //
					   if(!empty($tfv['name'])){
					    //gets the file extension
					     $e_spt=explode('.',$tfv['name']);
					     $f_ext=(count($e_spt)>1) ? ".".$e_spt[(count($e_spt)-1)] : null;
					      if(!empty($f_ext)){ $t_upload[$fi_hand]['ext']=$f_ext; }
						  $this->miscu(array( 'obj'=>'random', 'type'=>'string', 'length'=>rand(8,13) ));
					    $f_name=$this->_random(array( 'obj'=>'id' )).$this->_random(array( 'obj'=>'string', 'length'=>rand(8,13) ));//file name
					    //save name
					     $sv_name=($filenames[$fi_hand]) ?? null;
					      $sv_name=(empty($sv_name)) ? $f_name.$f_ext : $sv_name;
					     if(!empty($sv_name)){ $t_upload[$fi_hand]['save_name']=$sv_name; }//stores the saved name
					    //path
					     if(!empty($dir)||!empty($dirs)){
						  if(is_array($dir)||is_array($dirs)){//multiple paths listing
					       $f_dir=($dirs) ?? ($dir);//switches between the multiple directory listing vs. singular
						   $st_dir=(isset($f_dir[$fi_hand])&&!empty($f_dir[$fi_hand])) ? $f_dir[$fi_hand] : $d_dir;
					       $t_upload[$fi_hand]['path']=$st_dir;//stores the upload path (directory)
					      }
					      elseif(!empty($dir)){
					       $t_upload[$fi_hand]['path']=$dir;//stores the upload path (directory)
					      }
					     } else{ $t_upload[$fi_hand]['path']=$d_dir; }
				        //
					     //upload
						  $is_skip=false;//checks if the upload should be skipped
						   if(is_array($_skip)){ $is_skip=(in_array($fi_hand, $_skip)==true) ? true : $is_skip; }
						   elseif(!empty($_skip)){ $is_skip=($_skip==$fi_hand) ? true : $is_skip; }
					      $t_upload[$fi_hand]['_upload']=($is_skip==false) ? true : false;//if the file should be uploaded
					    //status & error
					     $t_upload[$fi_hand]['status']=($is_skip===true) ? -2 : null;
					     $t_upload[$fi_hand]['err']=array();
					   }
					 }
					//check if the file error, size, & type are allowed and checks if the file already exists
					 //check
					  //errors
					   foreach($t_upload as$tfi=>$tfv){//loops through the upload holder
					    if(!empty($t_upload['error'])){//if a file upload error occured
					     $f_err=$t_upload[$tfi]['error']; $er_msg=null;//gets the error
						   $f_err=rand(2,7);
					 	 //checks the error
						  //error message build
						   if($f_err==2){ $er_msg=$this->resources['_lang']['the file is too big for the system']; }
						   elseif($f_err==3){ $er_msg=$this->resources['_lang']['the file is too big for the page']; }
						   elseif($f_err==5){ $er_msg=$this->resources['_lang']["the temporary upload holder isn't working"]; }
						   elseif($f_err==6){ $er_msg=$this->resources['_lang']['the file failed to write to the disk']; }
						   elseif($f_err==7){ $er_msg=$this->resources['_lang']['a php extension stopped the file from uploading']; }
						  //house keeping
						   $t_upload[$tfi]['err']=array( 'error_id'=>.3, 'error_num'=>$f_err, 'message'=>$er_msg );//builds the error array
						   $t_upload[$tfi]['status']=false;//stauts
						   $t_upload[$tfi]['_upload']=false;//upload
					    }
					   }
					  //type & extension
					   foreach($t_upload as$tfi=>$tfv){//loops through the upload holder
					    if(!isset($tfv['err']['error_id'])){//if no error occured
						 $f_type=$tfv['type']; $f_ext=$tfv['ext'];//file type and extension
						 //
						  //type
						   if(!empty($f_type)){
							if(is_array($filetypes)&&(count($filetypes)>1)){//if the file type is in an array
						     if(isset($filetypes[$tfi])){ $ft_srh=strpos($f_type, $ftv); $t_upload[$tfi]['check']['type']=($ft_srh>=1||($ft_srh===0)) ? true : false; }
							 else{
							  foreach($filetypes as$fti=>$ftv){//loops through the filetypes
							   $ft_srh=strpos($f_type, $ftv);//searches the file type
							   $t_upload[$tfi]['check']['type']=($ft_srh>=1||($ft_srh===0)) ? true : false;
							   if($ft_srh>=1||($ft_srh===0)){ break; }
							  }
							 }
						    }
						    elseif(!empty($filetypes)){//if the filetype(s) is a plain string
						     //searches the file type
						      if(is_array($filetypes)&&(count($filetypes)==1)){ $ft_srh=strpos($f_type,$filetypes[0]); }
							  else{ $ft_srh=strpos($f_type,$filetypes); }
						     $t_upload[$tfi]['check']['type']=($ft_srh>=1||($ft_srh===0)) ? true : false;
						    }
						     else{ $t_upload[$tfi]['check']['type']=0; }
							//disallowed
							 if(!empty($ty_disallowed)){
							  $is_dis=null;//checks if the file extension is disallowed
							   if(is_array($ty_disallowed)){//array
							    $is_dis=( (in_array($f_type,$ty_disallowed)===true)||(isset($ty_disallowed[$f_type])) ) ? true : false;
							   }
							   elseif(!empty($ty_disallowed)&&is_string($ty_disallowed)){//non-array
							    $d_srh=strpos($f_type, $ty_disallowed);
							    $is_dis=( ($ty_disallowed===$f_type)||( $d_srh>=1||(($d_srh===0)==true) ) ) ? true : false;
							   }
							  //
							   if($is_dis==true){//if the extension is disallowed
							    $t_upload[$tfi]['check']['type']=0;//switches the value to false
							   }
							 }
						   }
						  //extension
						   if(!empty($f_ext)){
							//
							 //file extension check
							  if(is_string($file_exts)){
							   $fe_s=strpos($file_exts,$file_exts_div);
							    if(($fe_s>=1)||(($fe_s===0)==true)){ $file_exts=explode($file_exts_div,$file_exts); }
							  }
							 if(is_array($file_exts)&&(count($file_exts)>1)){//array
							  if(isset($file_exts[$tfi])){
							   //$fe_srh=strpos($f_ext, $file_exts);
							   //$t_upload[$tfi]['check']['ext']=($fe_srh>=1||($fe_srh===0)) ? true : false;
							   $t_upload[$tfi]['check']['ext']=true;
							  }
							  else{
							   foreach($file_exts as$fei=>$fev){
								$fe_srh=strpos($f_ext, $fev);
								$t_upload[$tfi]['check']['ext']=(($fe_srh>=1||($fe_srh===0))  &&($fev==$f_ext)) ? true : false;
							    if($fe_srh>=1||($fe_srh===0)){ break; }
							   }
							  }
							 }
							 elseif(!empty($file_exts)){//plain string
							  //searches the file extension
							   if(is_array($file_exts)&&(count($file_exts)==1)){ $fe_srh=strpos($f_ext,$file_exts[0]); }
							   else{ $fe_srh=strpos($f_ext,$file_exts); }
							  $t_upload[$tfi]['check']['ext']=($ft_srh>=1||($ft_srh===0)) ? true : false;
							 }
							  else{ $t_upload[$tfi]['check']['ext']=0; }//default
							//disallow search
							 if(!empty($ex_disallowed)){
							  $is_dis=null;//checks if the file extension is disallowed
							   if(is_array($ex_disallowed)){//array
							    $is_dis=( (in_array($f_ext,$ex_disallowed)===true)||(isset($ex_disallowed[$f_ext])) ) ? true : false;
							   }
							   elseif(!empty($ex_disallowed)&&is_string($ex_disallowed)){//non-array
							    $d_srh=strpos($f_ext, $ex_disallowed);
							    $is_dis=( ($ex_disallowed===$f_ext)||( $d_srh>=1||(($d_srh===0)==true) ) ) ? true : false;
							   }
							  //
							   if($is_dis==true){//if the extension is disallowed
							    $t_upload[$tfi]['check']['ext']=0;//switches the value to false
							   }
							 }
						   }
						}
					   }
					  //size
					   foreach($t_upload as$tfi=>$tfv){//loops through the upload holder
					    //
						 $c_size=$tfv['size'];//gets the file size
						 $mx_size=$m_size;//get the max size
						 $ch_sz=null;//check size flag
						//
						 if(!empty($c_size)&&($c_size>0)){
						  $ch_sz=(($c_size<=$mx_size)&&($c_size>=0)) ? 1 : 0;//checks if the size is apporiate
						   if(!empty($_size)){ $ch_sz=($c_size<=$_size&&($c_size>=0)) ? 1 : 0; }//user provided size override
						  $t_upload[$tfi]['check']['size']=$ch_sz;//switches the value to false
						 }
						  else{ $t_upload[$tfi]['check']['size']=false; }
						 //disallowed
						  if(!empty($sz_disallowed)){
						   $is_dis=null;//checks if the file extension is disallowed
							if(is_array($sz_disallowed)){//array
							 foreach($sz_disallowed as$dzi=>$dzv){
							  $is_dis=(($c_size<=((int)$dzv))) ? false : true;
							   //if($is_dis==true){ break; }
							 }
							}
							elseif(!empty($sz_disallowed)&&(is_string($sz_disallowed)||is_numeric($sz_disallowed))){//non-array
							 $is_dis=( ($c_size<=((int)$sz_disallowed)) ) ? false : true;
							}
						   //
							if($is_dis==true){//if the extension is disallowed
							 $t_upload[$tfi]['check']['size']=0;//switches the value to false
							}
						  }
					   }
					 //file exists
					  foreach($t_upload as$tfi=>$tfv){//loops through the upload holder
					   $_fn=($tfv['path'].$tfv['save_name']);//gets the file path
					   $t_upload[$tfi]['check']['exists']=(file_exists($_fn)) ? 1 : -1;
					  }
				   //file upload
				    foreach($t_upload as$tfi=>$tfv){//loops through the upload holder
					 //
					  $pre_ch=false;//pre-check flag
					   $pc_cnt=0; $pc_num=6;//check number
					  $f_dt=array(
					   'name'=>$tfv['save_name'],
					   'tmp'=>$tfv['tmp_name'], 'path'=>$tfv['path']//tmp_name & path
					  );
					 //
					  //pre-upload checks
					   if((($tfv['check']['type']===0)==false)){ $pc_cnt++; }//type
					   if((($tfv['check']['ext']===0)==false)){ $pc_cnt++; }//extension
					   if((($tfv['check']['size']===0)==false)){ $pc_cnt++; }//size
					   if($tfv['check']['exists']==-1||$tfv['check']['exists']=='-1'){ $pc_cnt++; }//exists check
					   //should upload check
					    if($tfv['_upload']==1){ $pc_cnt++; }
					   if(empty($tfv['err']['error_id'])){ $pc_cnt++; }//error check
					   //
					    if($pc_cnt==$pc_num){//if the pre-check passed
					     $t_upload[$tfi]['check']['pass']=1;//pass flag
					    }
					    else{//if the pre-check failed
					 	 $t_upload[$tfi]['err']=array( 'error_id'=>.9, 'error_num'=>'11', 'message'=>$this->resources['_lang']['upload validation fail'] );//builds the error array
						 $t_upload[$tfi]['status']=-1;//stauts
						 $t_upload[$tfi]['_upload']=0;//upload
					    }
					 //
					  if($t_upload[$tfi]['check']['pass']===1){//if the file should be uploaded
					   if(move_uploaded_file($f_dt['tmp'],($f_dt['path'].$f_dt['name']))){//attempts to upload the file
					    $t_upload[$tfi]['status']=1;//stauts
					   }
					    else{//if the upload fails 
						 $t_upload[$tfi]['err']=array( 'error_id'=>11, 'error_num'=>'12', 'message'=>$this->resources['_lang']['unable to upload file'] );//builds the error array
						 $t_upload[$tfi]['status']=0;//stauts
						}
					  }
					}
				  //sets the results
				   $_upload=$t_upload;
			   } else{ $u_res=false; }
			  //output
			   if($u_res===false){ $output=$u_res; }
			   else{ $output=$_upload; }
			 }
		  }
	   }
	  //lang: language interface
	   protected function _lang($__ap){
	    //values
	     $output=null; $_output=null;$_oupt=null;//output
		 $obj=($__ap['objective']) ?? ($__ap['obj']) ?? false;//objective
	     $u_lang=($__ap['lang']) ?? ($__ap['language']) ?? ($this->_rsrc['language']) ?? ($this->__defaults['language']) ?? null;//user language
	     $_return=($__ap['return type']) ?? ($__ap['return_type']) ?? ($__ap['return']) ?? null;//return type
	     $_trail=($__ap['trail']) ?? ($__ap['directory trail']) ?? ($__ap['directory_trail']) ?? ($__ap['dir trail']) ?? ($__ap['dir_trail']) ?? null;//directory trail
	     $_ext=($__ap['file_extension']) ?? ($__ap['file extension']) ?? ($__ap['extension']) ?? 'json';//file extension
	     //pre-sets
	      $_dir=$this->_rsrc['_locs']['lang_dir'];//language directory
		  $_file=null; $_files=array(//language files
		   'af'=>'afrikaans', 'ar'=>'arabic', 
		   'de'=>'german', 
		   'en'=>'english', 'es'=>'spanish', 
		   'fr'=>'french',
		   'hi'=>'hindi',
		   'it'=>'italian', 
		   'ja'=>'japanese',
		   'ko'=>'korean', 
		   'nl'=>'dutch',
		   'ru'=>'russian',
		   'th'=>'thai',
		   'vi'=>'vietnamese',
		   'zh'=>'chinese'
		  );
	    //
	     try{//checks the objective
	      if(!empty($obj)){
		   if($obj=='_load'){//opens & loads the language file
		    //vals
		     $lb_file=($__ap['file']) ?? ($__ap['lang file']) ?? ($__ap['lang_file']) ?? ($__ap['language']) ?? null;//language bank file
		     $oa_type=($_return=='obj'||$_return=='object') ? false : true;//object or array flag
			 $u_bank=($__ap['bank']) ?? ($__ap['language_']) ?? ($__ap['lang bank']) ?? ($__ap['lang_bank']) ?? ($__ap['language bank']) ?? ($__ap['language_bank']) ?? null;//language bank
		     $_open=($__ap['open']) ?? ($__ap['file']) ?? ($__ap['load']) ?? false;//open flag
			 if((($_open===false)==false)||empty($lb_file)){ //if(empty($lb_file)){//sets the file
		       if($u_lang=='de'){ $_file=$_files['de']; }//german
		       elseif($u_lang=='en'){ $_file=$_files['en']; }//english
		       elseif($u_lang=='es'){ $_file=$_files['es']; }//spanish
		       elseif($u_lang=='fr'){ $_file=$_files['fr']; }//french
			   else{ $_file=$_files['en']; }//defaults to english
		 	  $lb_file=($_trail).($_dir).($_file.'.'.$_ext);//builds the file path
			 } //}
		    //
		     //pulls the language data from the file if need be
			  if(!empty($lb_file)){//attempts to open the file
		       $f_exists=(file_exists($lb_file)) ? true : false;//checks if the file exists
			   if($f_exists==true){//if the file exists
			    $__bnk=file_get_contents($lb_file);//opens the file
			    $_bank=($_ext=='json') ? json_decode($__bnk,$oa_type) : $__bnk;//stores the langauge file
			   }
			  }
			  //checks to see if a user provided language bank is avaliable
			   $_bank=(empty($_bank)) ? $u_bank : $_bank;
			   

			 //attempts to store the bank in the class
			  if(!empty($_bank)){
			   if(!empty($u_lang)){//if a user language is provided
		 	    //storage
			     if(is_array($_bank)||is_object($_bank)){//if a language bank was opened
			      $this->_rsrc['language']=$u_lang;//sets the user language
			      $this->_rsrc['_lang']=$_bank;//sets the class language bank
			      //checks if the language bank was set
			       if($this->_rsrc['_lang']==$_bank){ $_oupt=true; }
			     } else{ $_oupt=false; }//if no language bank could be opened
			   } else{ $_oupt=false; }//if no user language was set
			  }
		   }
		    elseif($obj=='open'){//opens a language file and live stores the data
		     //vals
		      $lb_file=null;//language bank file
		      $oa_type=($_return=='obj'||$_return=='object') ? false : true;//object or array flag
		     //
		      //sets the file
		       if($u_lang=='de'){ $_file=$_files['de']; }//german
		       elseif($u_lang=='en'){ $_file=$_files['en']; }//english
		       elseif($u_lang=='es'){ $_file=$_files['es']; }//spanish
		       elseif($u_lang=='fr'){ $_file=$_files['fr']; }//french
		 	  $lb_file=($_trail).($_dir).($_file.'.'.$_file_ext);//builds the file path
		      //attempts to open the file
		       $f_exists=(file_exists($lb_file)) ? true : false;//checks if the file exists
			   if($f_exists==true){//if the file exists
			    $__bnk=file_get_contents($lb_file);//opens the file
			    $_bank=($_file_ext=='json') ? json_decode($__bnk,$oa_type) : $__bnk;//stores the langauge file
			    $_oupt=$_bank;//sets the bank for output
			   }
			    else{ $_oupt=false; }//if the file doesn't exists
		    }
		    elseif($obj=='store'){//stores a language file into the sys class
		     //vals
		      $_set=false;//set flag
		      $_bank=($__ap['bank']) ?? ($__ap['language_']) ?? ($__ap['lang bank']) ?? ($__ap['lang_bank']) ?? ($__ap['language bank']) ?? ($__ap['language_bank']) ?? null;//language bank
		     //
		      if(!empty($u_lang)){//if a user language is provided
		 	    //opens language bank
			     if(empty($_bank)){ $_bank=$this->_lang(array( 'obj'=>'open', 'lang'=>$u_lang, 'trail'=>$_trail )); if(empty($_bank)||$_bank==false){ $_bank=$this->_resource['_lang']; } }
			    //storage
			     if(is_array($_bank)||is_object($_bank)){//if a language bank was opened
			      $this->_rsrc['language']=$u_lang;//sets the user language
			      $this->_rsrc['_lang']=$_bank;//sets the class language bank
			      //checks if the language bank was set
			       if($this->_rsrc['_lang']==$_bank){ $_oupt=true; }
			     } else{ $_oupt=false; }//if no language bank could be opened
			   } else{ $_oupt=false; }//if no user language was set
		    }
		   else{ $_oupt=false; }//default non sepcified objective
		  } else{ $_oupt=false; }
	     }
		  catch(Exception $exc){//exception handler
		   $ex_code='_lang-xx-';//exception error flag & error code
		   $this->_err(array( 'obj'=>'store', 'error_form'=>'exception', 'error_code'=>$ex_code,//stores the error
		    'error_id'=>$this->_miscu(array( 'obj'=>'random', 'type'=>'id' )), 'error_message'=>$exc->getMessage()
		   ));
		  }
		  finally{
		   if(!empty($_output)){ $output=$_output; }else{ $output=$_oupt; }
		   return$output; 
		  }
	   }
	  //_miscu: miscellaneous bits
	   protected function _miscu($__ap){
	    //values
	     $output=null; $_output=null; $_oupt=null; $obj=null;//init
	      $obj=($__ap['obj']) ?? ($__ap['objective']) ?? 'mail';//objective
	    //
	     if($obj===false){  }
	     else{//if an objective was found
		  if($obj=='date'||$obj=='_date'){//date
		   //values
		    $_focus=($__ap['_f']) ?? ($__ap['focus']) ?? ($__ap['_focus']) ?? ($__ap['_date_obj']) ?? ($__ap['obj_2']) ?? null;//focus
		    $dt_dis=null;//date display
		   //
		    //checks the focus
		     if($_focus=='timestamp'||$_focus=='stamp'){//timestamp (stamp)
		      //
		       $version=($__ap['version']) ?? null;//timestamp version
		 	   $split=($__ap['split']) ?? null;//timestamp split
			    $split_v=($__ap['split']) ?? ($__ap['split_value']) ?? ($__ap['split value']) ?? '_';
			   $tm_st=null;//timestamp
		      //
		       //
			    if($_focus=='timestamp'){//timestamp
			     if($version==1){ $tm_st=date('dS F Y G:i:s');  }//old version timestamp
			     else{ $tm_st=date('Y m d G:i:s'); }//new (standard version)
			    }
			    elseif($_focus=='stamp'){
			     if(!empty($split)){ $tm_st=date('Y'.$split_v.'m'.$split_v.'d'.$split_v.'G'.$split_v.'i'.$split_v.'s'); }
			     else{ $tm_st=date('Ymdhis');  }
			    }
			   //
			    $output=(!empty($tm_st)) ? $tm_st : false;//defaults to false if no timestamp set
		     }
		     elseif($_focus=='timezone'){//timezone
		      //vals
		       $do=($__ap['do']) ?? ($__ap['obj_second']) ?? ($__ap['objective_second']) ?? ($__ap['obj second']) ?? ($__ap['objective second']) ?? null;//secondary objective
			   $t_z=($__ap['timezone']) ?? ($__ap['time zone']) ?? ($__ap['time_zone']) ?? null;//timezone value
		      //
		       //checks what to do
  			    if($do=='set'){//set the timezone value
			     if(empty($t_z)){ $output=false; }//if the timezone value is empty
			     else{
			      date_default_timezone_set($t_z);//changes the default time zone
			      $this->timezone=$t_z;//sets the class timezone value
			      $output=(($this->timezone===$t_z)&&( date('e')===$t_z )) ? true : false;//sets the output
			     }
			    }
			    else if($do=='get'){//gets the timezone vlaue
			     //values
			      $g_oupt=null;//gets output
			      $get=($__ap['get']) ?? null;
			      $cl_tz=null; $sy_tz=null;//class and system timezone values
			     //
			      //gets the values
			       $cl_tz=$this->timezone;//gets the class timezone values
			       $sy_tz=date('e');//gets the system timezone value
			      //
			       if(!empty($get)){//if the get type is set
			        if($get=='class'||$get=='self'){ $g_oupt=$cl_tz; }
				    elseif($get=='system'||$get=='main'){ $g_oupt=$sy_tz; }
				   }
				   else{ $g_oupt=$sy_tz; }//defaults to returning the system timezone
			      //
			       $output=$g_oupt;//shifts the gets output to the main output
			    }
		     }
		    //output
		     return$output;
		  }
		  elseif($obj=='is_sn'||$obj=='is scientific notation'||$obj=='is_scientific_notation'||$obj=='scientific notation'||$obj=='scientific_notation'){//checks if a number is scientific notation
		   //values
		    $pattern = '/^[+-]?\d+(\.\d+)?[eE][+-]?\d+$/';//pattern
		    $number=($__ap['number']) ?? ($__ap['numb']) ?? 0;
		   //
		    return preg_match($pattern, $number) === 1;
		  }
	      elseif($obj=='convert_sn'||$obj=='convert scientific notation'||$obj=='convert_scientific_notation'){
		   //values
		    $number=($__ap['number']) ?? ($__ap['numb']) ?? 0;
		   //
		    //return sprintf('%.0f', $number);
		    return number_format($number,15);
		  }
		  elseif($obj=='mailer'||$obj=='mail'){
	       //values
		    $_header=($__ap['header']) ?? ($__ap['hdr']) ?? ($__ap['_header']) ?? ($__ap['_hdr']) ?? null;//header
		    $_sender=($__ap['from']) ?? ($__ap['sender']) ?? ($__ap['address from']) ?? ($__ap['address_from']) ?? null;//sender
		    $_to=($__ap['to']) ?? ($__ap['send']) ?? ($__ap['send to']) ?? ($__ap['send_to']) ?? ($__ap['address to']) ?? ($__ap['address_to']) ?? ($__ap['to address']) ?? ($__ap['to_address']) ?? null;//address to send to
		    $_to_name=($__ap['name']) ?? ($__ap['sender name'])  ?? ($__ap['sender_name'])  ?? ($__ap['from']) ??($__ap['from name']) ?? ($__ap['from_name']) ?? null;//sender name
		    $_subject=($__ap['subject']) ?? ($__ap['sub']) ?? ($__ap['topic']) ?? null;//subject
		    $_message=($__ap['message']) ?? ($__ap['msg']) ?? null;//message
		    $_sent=null;//sent flag
		   //
		    try{
		     if(($obj===false)==false){//if a objective has been found
		      if($obj=='mail'){//mail objective
			   $header=($_header) ?? null; if(empty($header)){//header build
			    $header="MIME-Version: 1.0\r\n";//MIME version
			    $header.="Content-type:text/html;charset=UTF-8\r\n";//content-type
			    $header.="From: ".$sender_name."<".$sender.">\r\n";//from
			    $header.="Reply-To: ".$sender."\r\n";//reply-to
			    $header.="Return-Path: ".$sender."\r\n";//return-path
			   }
			   //attempts to send mail
			    if(!empty($_to)){//if a to address is provided
			     if(mail($_to, $_subject, $_message, $header)){ $__sent=true; }
			     else{ $__sent=false; }
			    } else{ throw new Exception($this->_lang['invalid send to address']); }
			  }
			  else{ throw new Exception($this->_lang['invalid objective']); }
		     } else{ throw new Exception($this->_lang['invalid objective']); }
		    }
		     catch(Exception $exc){//exception handler
		      $ex_code='_mailer-xx-';//exception error flag & error code
		      $this->_err(array( 'obj'=>'store', 'error_form'=>'exception', 'error_code'=>$ex_code,//stores the error
		       'error_id'=>$this->_miscu(array( 'obj'=>'random', 'type'=>'id' )), 'error_message'=>$exc->getMessage()
		      ));
		     }
		     finally{
		      if(!empty($_output)){ $output=$_output; }else{ $output=$__sent; }
		      return$output; 
		     }
		  }
		  elseif($obj=='random'){//random number (id) generator
		   //values
		    $oupt=null; $r_type=(isset($__ap['type'])) ? ($__ap['type']) : null;
		     $code=(in_array('code', array_values($__ap))===true) ? 1 : 0;
		   //
		    //checks the objective
		     if($r_type=='id'){
		      $sm=date('sv')*11;//second & milliseconds
		      //date
			   $dte=($code===1) ? date('YWmd-His') : date('YWmdHis');//date
		       $dte.=($code===1) ? '-'.date('z') : date('z');//adds the day number
		      $id=($code===1) ? $dte.'.'.rand(0,$sm) : $dte.rand(0,$sm);//builds the id string
			  $oupt=$id;//sets the id for outputing
		     }
		     elseif($r_type=='id_'){
		      $sm=date('u')*11;//second & milliseconds
		      //date
		       $dte=($code===1) ? date('Z').'-' : date('Z');//
		       $dte.=($code===1) ? date('YWmd-His') : date('YWmdHis');//date
		      $id=($code===1) ? $dte.'.'.$sm : $dte.date('u');//builds the id string
			  $oupt=$id;//sets the id for outputing
		     }
		     else{ $oupt=rand(); }//defaults to a rand string
		    return$oupt;//return the generated text
		  }
		  elseif($obj=='random_'){//random generator
		   //values
		    $output=null;//output
		    $_focus=($__ap['focus']) ?? ($__ap['_focus']) ?? null;//objective
		    $length=($__ap['length']) ?? ($__ap['len']) ?? null;//length
		    $u_bank=($__ap['bank']) ?? ($__ap['character bank']) ?? ($__ap['character_bank']) ?? ($__ap['chr_bank']) ?? ($__ap['chr bnk']) ?? ($__ap['number bank']) ?? ($__ap['number_bank']) ?? ($__ap['num bank']) ?? ($__ap['num_bank']) ?? null;//bank
		   //
		    //
		     if(!empty($_focus)){//if the objective isn't empty
		      if($_focus=='id'||$_focus=='id'){//id generator
			   //values
			    $i_=array();//info placeholder
			    $i_txt=null; $i_dt=null; $i_st=null;//id text, data, & stamp
			    $id_=($__ap['id']) ?? null;//id base
			    $_div=($__ap['divider']) ?? ($__ap['divd']) ?? ($__ap['div']) ?? ($__ap['d']) ?? '-';//string divider
			    $sh_divider=($__ap['show_divider']) ?? ($__ap['show divider']) ?? ($__ap['show_divd']) ?? ($__ap['show divd']) ?? ($__ap['show_div']) ?? ($__ap['show div']) ?? ($__ap['show_d']) ?? ($__ap['show d']) ?? 0;//show divider
			    $sh_week=($__ap['show_week']) ?? ($__ap['show week']) ?? ($__ap['week']) ?? null;//show week flag
			    $numeric=($__ap['numbers']) ?? ($__ap['number']) ?? ($__ap['is_number']) ?? ($__ap['is number']) ?? null;//number flag
			    $string=($__ap['string']) ?? ($__ap['is_string']) ?? ($__ap['is string']) ?? null;//string
			    $version=($__ap['version']) ?? ($__ap['ver']) ?? ($__ap['v']) ?? null;//version
			    $stamp=($__ap['stamp']) ?? ($__ap['timestamp']) ?? 1;//timestamp flag
			    $range=($__ap['range']) ?? null;//range flag
			     $range_start=($__ap['range start']) ?? ($__ap['range_start']) ?? ($__ap['start']) ?? 0;//range start
			     $range_end=($__ap['range end']) ?? ($__ap['range_end']) ?? ($__ap['end']) ?? 0;//range end
			     $r_divd=($__ap['range divider']) ?? ($__ap['range_divider']) ?? ($__ap['divider']) ?? '-';//range divider
			   //
			    //
			     //
			      $n_id=null; $nw_id=null;//new id placeholder
			     //pre-build
			      if($stamp==1){//if time stamp info should be included
			       $i['st']['y']=date('Y'); $i['st']['m']=date('m'); $i['st']['d']=date('d');//year, month, & date info
			       $i['st']['ho']=date('G'); $i['st']['mi']=date('i'); $i['st']['se']=date('s');//hour, minute, & second info
				    $i['st']['ms']=date('v'); $i['st']['w']=date('W');//milliseconds & week code
			      }
			      //range info
			       //range start and end
				    $e_srh=(!empty($range)) ? strpos($range,$r_divd) : false;
				    if(($e_srh>=1)||(($e_srh===0)==true)){//splits the range values
				     $rg_ex=explode($r_divd, $range);
				     $range_start=(empty($range_start)&&!empty($rg_ex[0])) ? $rg_ex[0] : $range_start;
				      $range_start=(empty($range_start)) ? 0 : $range_start;//default to 0
				     $range_end=(empty($range_end)&&!empty($rg_ex[1])) ? $rg_ex[1] : $range_end;
				      //$range_end=(empty($range_end)) ? rg_ex[1] : $range_end;//default to whatever the second split value is
				    }
			       if(!empty($range)){ $i_dt=rand(((int)$range_start), ((int)$range_end)); }
				   elseif($range===true){ $i_dt=rand(1); }
				   else{ $i_dt=$id_; }
			     //
			      //creates the stamp string
				   foreach($i['st'] as$sti=>$stv){ if($sti!='w'){ $i_st.=$stv; } if($sh_divider==1){ $i_st.=$_div; } trim($i_st,$_div); }
				   $i_wk=$i['st']['w'];//getst the week number
				  //new id build
				    $n_id=($i_dt!=0) ? $i_dt : null;//adds the id "base"
				    $n_id.=$i_st;//adds the timestamp info
				     $n_id.=$_div.$i_wk;//adds the week 
				    //  
				   $nw_id=$n_id;//output shift
				   if(!empty($length)){//length check
				    $i_len=strlen($nw_id);//gets the string length
				    if($i_len>$length){//if the id is too long
				     $sh_id=null; for($lc=0;$lc<$length;$lc++){ $sh_id.=$nw_id[$lc]; } $nw_id=$sh_id;
				    }
				    elseif($i_len<$length){//if the id is too short
				     //
				      $l_dif=((int)$length)-((int)$i_len);
					  $sh_id=null;
				     //
				      //for($al=0;$al<$length;$al++){
					   if($numeric==true||$numeric==1){ $sh_id=$this->_random(array( 'obj'=>'number', 'length'=>$l_dif )); }
					   elseif($string==true||$string==1){ $sh_id=$this->_random(array( 'obj'=>'char', 'length'=>$l_dif )); }
					   else{ $sh_id=$this->_random(array( 'obj'=>'string', 'length'=>$l_dif )); }
					  //}
					  $nw_id.=$sh_id;
				    }
				   }
			     $output=$nw_id;//sets the new id for outputing
			  }
			  elseif($_focus=='char'){//character generator
			   //values
			    $length=(empty($length)) ? rand(20,32) : $length;//length default
			    $k_bnk=array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );//character strings
			    $n_new=null; $_new=null;//new number string
			   //
			    //
			     for($nl=0;$nl<$length;$nl++){//loops through the string length
			      //adds the new string
				   if(!empty($u_bank)){ $ub_cnt=(is_array($u_bank)) ? count($u_bank) : 0; $ud_id=($_rnd==true) ? rand(0, $ub_cnt) : $nl; $_new.=(is_array($u_bank)) ? $u_bank[$ud_id] : $u_bank; }
				   else{ $k_id=rand(0, count($k_bnk)); $_new.=$k_bnk[$k_id]; }
			     }
			    $output=$_new;//sets the output
			  }
			  elseif($_focus=='number'){//number 
			   //values
			    $length=(empty($length)) ? rand(20,32) : $length;//length default
			    $k_bnk=array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );//number strings
			    $n_new=null; $_new=null;//new number string
			   //
			    //
			     for($nl=0;$nl<$length;$nl++){//loops through the string length
			      //adds the new string
				   if(!empty($u_bank)){ $ub_cnt=(is_array($u_bank)) ? count($u_bank) : 0; $ud_id=($_rnd==true) ? rand(0, $ub_cnt) : $nl; $_new.=(is_array($u_bank)) ? $u_bank[$ud_id] : $u_bank; }
				   else{ $k_id=rand(0, count($k_bnk)); $_new.=$k_bnk[$k_id]; }
			     }
			    $output=$_new;//sets the output
			  }
			  elseif($_focus=='string'){//string generator
			   //values
			    $n_str=null; $nw_str=null;//new string placeholder
			   //
			    //
			     //
			      for($sl=0;$sl<$length;$sl++){
			       if($numeric==true||$numeric==1){ $n_str.=$this->_miscu(array( 'obj'=>'random', 'focus'=>'number', 'length'=>1 )); }
			       elseif($string==true||$string==1){ $n_str.=$this->_miscu(array( 'obj'=>'random', 'focus'=>'char', 'length'=>1 )); }
			       else{ $n_c=((rand(0,1))==1) ? 'char' : 'number'; $n_str.=$this->_miscu(array( 'obj'=>'random', 'focus'=>$n_c, 'length'=>1 )); }
			      }
			     $nw_str=$n_str;
			    $output=$nw_str;//sets the output
			  }
			 }
		  }
		  elseif($obj=='reload'){//reload html/javascript snippet
		   //values
		    $url=($__ap['url']) ?? false;//url
		    $d_output=($__ap['output']) ?? ($__ap['echo']) ?? null;//display output
		    $time=($__ap['time']) ?? 0;//time
		    $html=null;//html placeholder
		   //
		    //html build
		     $html='<meta http-equiv="refresh" content="'.$time.';url='.$url.'">';//html reload
		     $html.="<script type='text/javascript'>";//javascript
		       $html.="window.setTimeout(function(){ window.location.href = '".$url."'; },".$time."000);";
			  $html.="</script>";
		    //output
		     if($d_output==true){ echo$html; }else{ return$html; }
		  }
	     }
	  }
	 
	 
	 //__init
	  function __construct($__ap){//construction call
	   //values
	   //
	    
	  }
    }
   }
 
   if(class_exists('tem')&&!class_exists('sys')){//if the upper level codebase hasn't been created
    class sys extends tem{//sys class
	 //variables
	 //functions
	  //_divs: div and display handler
	   public function _div($_ap){
		//values
		 $_output=null; $output=null; $oupt=null;$_oupt=null;//output
		 $_div=($_ap['div']) ?? ($_ap['div id']) ?? ($_ap['div_id']) ?? ($_ap['id']) ?? null;//div id & name
		 $d_data=null;//div data container
		//
		 //checks what div to show
		  if(!empty($_div)){
		   if($_div==''){
		   }
		  }
		 //output handler
		  $_output=($_oupt) ?? ($oupt) ?? null;//sets the output container value
		  if(empty($_output)){ $output=$_output; }//if the output is null
		  else{//if the output isn't empty
		   $output=$_output;//sets the value for returnal
		  }
		 return$output;
	   }
	  //forms: form handler
	   public function _form($_ap){
		//values
		 $_output=null; $output=null; $oupt=null;$_oupt=null;//output
		 $_lang=$this->_lang;//langauge reference
		 $_form=($_ap['form']) ?? ($_ap['form id']) ?? ($_ap['form_id']) ?? ($_ap['id']) ?? null;//form id & name
		 $f_data=null;//form data container
		//
		 //checks what form to show
		  if(!empty($_form)){
		   if($_form=='admin_login'){//admin login form
		    //vals
			 $al_form=null;//form html container
			 $pt_al_user=($_POST['al_user']) ?? null;//form post data - user id
			 $pt_al_pass=($_POST['al_pass']) ?? null;//form post data - password
			//
			 //form build
			  $al_form="<form class='form' action='".$_SERVER['REQUEST_URI']."' method='post'>";//
			   //
			    //id
			     $al_form.="<div id='al_container_whole_id' class='_cont'>";
				  $al_form.="<div id='al_id_label' class='label_'>".$_lang['id_']."</div>";//
				  $al_form.="<div id='al_id_input' class='field_'> <input type='text' class='input' name='al_user' value='".$pt_al_user."' /> </div>";
				 $al_form.="</div>";
			    //password
			     $al_form.="<div id='al_container_whole_pass' class='_cont'>";
				  $al_form.="<div id='al_pass_label' class='label_'>".$_lang['password']."</div>";//
				  $al_form.="<div id='al_pass_input' class='field_'> <input type='password' class='input' name='al_pass' value='".$pt_al_pass."' /> </div>";
				 $al_form.="</div>";
			   
			   //submit button
			    $al_form.="<div id='al_submit' class='_cont'>";
				 $al_form.="<input type='submit' class='btn' value='".$_lang['login']."' />";
			    $al_form.="</div>";
			  $al_form.="</form>";//
			 $f_data=$al_form;//sets the form for returnal
		   }
		   $_oupt=$f_data;//sets the form data for output
		  }
		 //output handler
		  $_output=($_oupt) ?? ($oupt) ?? null;//sets the output container value
		  if(empty($_output)){ $output=$_output; }//if the output is null
		  else{//if the output isn't empty
		   $output=$_output;//sets the value for returnal
		  }
		 return$output;
	   }
	 
	 //__init
	  function __construct($__ap){//construction call
	   //values
	   //
	    parent::__construct($__ap);//calls the parent construction method
	  }
    }
   }
  
  if(class_exists('tem')&&class_exists('sys') &&!class_exists('_syst')){
   class _syst extends sys{//system fully assembled
	 //variables
	  
	 //functions
	  //_interf: public private bridge interface
	   public function _interf($__ap){
	   //values
	    $_oupt=null; $output=null; $_output=null;
		 $do=($__ap['do']) ?? ($__ap['obj']) ?? ($__ap['objective']) ?? false;
		 $function=($__ap['function']) ?? ($__ap['fun']) ?? ($__ap['f']) ?? false;
		 $_ap=($__ap['attributes']) ?? ($__ap['attribute']) ?? ($__ap['attr']) ?? ($__ap['attrs']) ?? ($__ap['a']) ?? ($__ap['parameters']) ?? ($__ap['para']) ?? ($__ap['parm']) ?? ($__ap['p']) ?? false;
		  $_var=($__ap['variable']) ?? ($__ap['varaibles']) ?? ($__ap['var']) ?? ($__ap['vars']) ?? ($__ap['get']) ?? null;
	      $_var_value=($__ap['variable value']) ?? ($__ap['variable_value']) ?? ($__ap['value']) ?? ($__ap['var val']) ?? ($__ap['var_val']) ?? ($__ap['var vals']) ?? ($__ap['var_vals']) ?? ($__ap['vars vals']) ?? ($__ap['vars_vals']) ?? ($__ap['variable val']) ?? ($__ap['variable_val']) ?? ($__ap['variable vals']) ?? ($__ap['variable_vals']) ?? null;
	   //
	    try{//determines what to do
		 //
		  if(!empty($do)){//
		   if($do=='reload'){ $_oupt=$this->_miscu(array_merge($__ap, array( 'obj'=>'reload' ))); }
		  }
		  elseif(!empty($function)){//functions interfaces
		   //
		    //D
			 if($function=='database' || $function=='_database' || $function=='db' || $function=='_db'){
			  //values
			  //
			   $_oupt=$this->_dbase($_ap);
			 }
			 elseif($function=='date' || $function=='_date' || $function=='_dte'){
			  //values
			  //
			   $_oupt=$this->_miscu(array_merge($_ap, array( 'obj'=>'_date' )));
			 }
			//E
			 elseif($function=='err' || $function=='_err' || $function=='error'){
			  //values
			  //
			   $_outp=$this->_err($_ap);
			 }
			//F
			 elseif($function=='form' || $function=='_form'){
			  //values
			  //
			   $_outp=$this->_form($_ap);
			 }
			//L
			 elseif($function=='lang' || $function=='_lang' || $function=='_language' || $function=='language'){
			  //values
			  //
			   $_oupt=$this->_lang($_ap);
			 }
			//M
			 elseif($function=='_miscu' || $function=='_misce' || $function=='miscellaneous' || 
			  $function=='output_handler' || $function=='output handler' || $function=='output processing' || $function=='output_processing' ||
			  $function=='random' || $function=='reload' || 
			  $function=='mailer' || $function=='mail' ||
			  $function=='is_sn'
			 ){//miscellaneous
			  //values
			  //
			   $_oupt=$this->_miscu($_ap);
			 }
			//T
			 elseif($function=='timestamp' || $function=='_stamp' || $function=='_timestamp'){
			  //values
			  //
			   $_oupt=$this->_miscu(array_merge($_ap, array( 'obj'=>'_date', 'obj_2'=>'timestamp' )));
			 }
			//
		  }
		  else{ $_oupt=false; }
		}
		 catch(Exception $ex_c){//exception catcher
		 }
		finally{ $output=($_output) ?? ($_oupt); }//output processing
		return$output;//output
	   }
	 
	 //__init
	  function __construct($__ap){//construction call
	   //values
	    $u_lang=($__ap['language']) ?? ($__ap['lang']) ?? ($__ap['lg']) ?? ($__ap['langu']) ?? $this->__defaults['language'];//user selected language
		$_trail=($__ap['trail']) ?? ($__ap['directory']) ?? ($__ap['directory trail']) ?? ($__ap['directory_trail']) ?? ($__ap['dir trail']) ?? ($__ap['dir_trail']) ?? ($__ap['trail directory']) ?? ($__ap['trail_directory']) ?? ($__ap['trail dir']) ?? ($__ap['trail_dir']) ?? null;//trail attribute
		//database
		 $db_conns=($__ap['db']) ?? ($__ap['database']) ?? ($__ap['_database']) ?? null;//database connection info
		 $db_multi=($__ap['db multi']) ?? ($__ap['db_multi'])  ?? ($__ap['database multiple']) ?? ($__ap['database_multiple'])   ?? ($__ap['database_multi']) ?? ($__ap['conn multi']) ?? null;//multiple connection flag
		 $db_multi_cnt=($__ap['db_multi_count']) ?? ($__ap['db multi count']) ?? ($__ap['db_multi_cnt']) ?? ($__ap['db multi cnt']) ?? ($__ap['database multiple count']) ?? ($__ap['database_multiple_count']) ?? ($__ap['database multi count']) ?? ($__ap['database_multi_count']) ?? ($__ap['database multi cnt']) ?? ($__ap['database_multi_cnt']) ?? ($__ap['multi_count']) ?? ($__ap['multi count']) ?? ($__ap['mult_cnt']) ?? ($__ap['multi cnt']) ?? 0;//database multiple connection count
		 $db_host=($db_conns['host']) ?? ($db_conns['db host']) ?? ($db_conns['db_host']) ?? ($db_conns['database host']) ?? ($db_conns['database_host']) ?? ($db_conns['hostname']) ?? ($__ap['host']) ?? ($__ap['db host']) ?? ($__ap['db_host']) ?? ($__ap['database host']) ?? ($__ap['database_host']) ?? ($__ap['hostname']) ?? null;//database host
		 $db_user=($db_conns['user']) ?? ($db_conns['username']) ?? ($db_conns['db user']) ?? ($db_conns['db_user']) ?? ($db_conns['db username']) ?? ($db_conns['db_username']) ?? ($db_conns['database user']) ?? ($db_conns['database_user']) ?? ($db_conns['database username']) ?? ($db_conns['database_username']) ?? ($__ap['user']) ?? ($__ap['username']) ?? ($__ap['db user']) ?? ($__ap['db_user']) ?? ($__ap['db username']) ?? ($__ap['db_username']) ?? ($__ap['database user']) ?? ($__ap['database_user']) ?? ($__ap['database username']) ?? ($__ap['database_username']) ?? null;//database user
		 $db_pass=($db_conns['pass']) ?? ($db_conns['password']) ?? ($db_conns['db pass']) ?? ($db_conns['db_pass']) ?? ($db_conns['db password']) ?? ($db_conns['db_password']) ?? ($db_conns['database password']) ?? ($db_conns['database_password']) ?? ($__ap['pass']) ?? ($__ap['password']) ?? ($__ap['db pass']) ?? ($__ap['db_pass']) ?? ($__ap['db password']) ?? ($__ap['db_password']) ?? ($__ap['database password']) ?? ($__ap['database_password']) ?? null;//database password
		 $db_base=($db_conns['base']) ?? ($db_conns['database']) ?? ($db_conns['db']) ?? ($db_conns['db base']) ?? ($db_conns['db_base']) ?? ($db_conns['base']) ?? ($__ap['base']) /*?? ($__ap['database'])*/ ?? ($__ap['db']) ?? ($__ap['db base']) ?? ($__ap['db_base']) ?? ($__ap['base']) ?? null;//database base
		//$top_level=( (in_array(array('host', 'user', 'pass', ), array_keys($db_conns))!=true) ) ? true : false;//top level flag
	   //
	    //print_r($db_conns); echo"<br/> top_level: ".$top_level; 
	    $top_level=null;//top level flag
		if($top_level==true){//if multiple connections are provided
		 echo" | balls<Br/><hr/>";
		  print_r($db_host); print_r($db_user);
		  print_r($db_pass); print_r($db_base);
		  
		 exit;
		 
		}
		 else{//if a singular connection is provided
		  //connection info
		   if(!empty($db_conns)){
			//connection count
			 if($db_multi==true){ $conn_cnt=($db_multi_cnt) ?? null; $conn_cnt=(($conn_cnt===null)&&is_array($db_conns)) ? count($db_conns) : $conn_cnt; }
			 else{
			  $conn_cnt=(is_array($db_conns)) ? count($db_conns) : 1;
			 }
 //echo"[{[".$conn_cnt."]}]";
			if($conn_cnt>1){//multiple connections
			 foreach($db_conns as$dbcbI=>$dbcbV){//loops through the list of database connections
			  //vals
			   //$_keys=(array_keys($db_conns)); $_key=$_keys[0];//gets the connection name
			   $dbc_host=($db_conns[$dbcbI]['host']) ?? ($db_conns[$dbcbI]['db host']) ?? ($db_conns[$dbcbI]['db_host']) ?? ($db_conns[$dbcbI]['database host']) ?? ($db_conns[$dbcbI]['database_host']) ?? ($db_conns[$dbcbI]['hostname']) ?? ($db_conns[$_key]['host']) ?? ($db_conns[$_key]['db host']) ?? ($db_conns[$_key]['db_host']) ?? ($db_conns[$_key]['database host']) ?? ($db_conns[$_key]['database_host']) ?? ($db_conns[$_key]['hostname']) ?? ($db_conns[$_key][0]) ?? null;//conncection host
			   $dbc_user=($db_conns[$dbcbI]['user']) ?? ($db_conns[$dbcbI]['username']) ?? ($db_conns[$dbcbI]['db user']) ?? ($db_conns[$dbcbI]['db_user']) ?? ($db_conns[$dbcbI]['db username']) ?? ($db_conns[$dbcbI]['db_username']) ?? ($db_conns[$_key]['database user']) ?? ($db_conns[$_key]['database_user']) ?? ($db_conns[$_key]['database username']) ?? ($db_conns[$_key]['database_username']) ?? ($db_conns[$_key][1]) ?? null;//conncection username
			   $dbc_pass=($db_conns[$dbcbI]['pass']) ?? ($db_conns[$dbcbI]['password']) ?? ($db_conns[$dbcbI]['db pass']) ?? ($db_conns[$dbcbI]['db_pass']) ?? ($db_conns[$dbcbI]['db password']) ?? ($db_conns[$dbcbI]['db_password']) ?? ($db_conns[$_key]['database password']) ?? ($db_conns[$_key]['database_password']) ?? ($db_conns[$_key][2]) ?? null;//conncection password
			   $dbc_base=($db_conns[$dbcbI]['base']) ?? ($db_conns[$dbcbI]['db']) ?? ($db_conns[$dbcbI]['db base']) ?? ($db_conns[$dbcbI]['db_base']) ?? ($db_conns[$dbcbI]['base']) ?? ($db_conns[$dbcbI][3]) ?? null;//conncection database
			  $conn_info=array(//if a singular connection info is provided
		       'host'=>$dbc_host, 'user'=>$dbc_user,
		       'pass'=>$dbc_pass, 'base'=>$dbc_base
		      );
			  $this->__info['database']['sql'][$conn_info['base']] = $conn_info;//stores the db connection info
			 }
			}
			//build
			 elseif($conn_cnt==1){//singular connection
			  //vals
			   $_keys=(array_keys($db_conns)); $_key=$_keys[0];//gets the connection name
			   $dbc_host=($db_conns[$_key]['host']) ?? ($db_conns[$_key]['db host']) ?? ($db_conns[$_key]['db_host']) ?? ($db_conns[$_key]['database host']) ?? ($db_conns[$_key]['database_host']) ?? ($db_conns[$_key]['hostname']) ?? ($db_conns[$_key]['host']) ?? ($db_conns[$_key]['db host']) ?? ($db_conns[$_key]['db_host']) ?? ($db_conns[$_key]['database host']) ?? ($db_conns[$_key]['database_host']) ?? ($db_conns[$_key]['hostname']) ?? ($db_conns[$_key][0]) ?? null;//conncection host
			   $dbc_user=($db_conns[$_key]['user']) ?? ($db_conns[$_key]['username']) ?? ($db_conns[$_key]['db user']) ?? ($db_conns[$_key]['db_user']) ?? ($db_conns[$_key]['db username']) ?? ($db_conns[$_key]['db_username']) ?? ($db_conns[$_key]['database user']) ?? ($db_conns[$_key]['database_user']) ?? ($db_conns[$_key]['database username']) ?? ($db_conns[$_key]['database_username']) ?? ($db_conns[$_key][1]) ?? null;//conncection username
			   $dbc_pass=($db_conns[$_key]['pass']) ?? ($db_conns[$_key]['password']) ?? ($db_conns[$_key]['db pass']) ?? ($db_conns[$_key]['db_pass']) ?? ($db_conns[$_key]['db password']) ?? ($db_conns[$_key]['db_password']) ?? ($db_conns[$_key]['database password']) ?? ($db_conns[$_key]['database_password']) ?? ($db_conns[$_key][2]) ?? null;//conncection password
			   $dbc_base=($db_conns[$_key]['base']) ?? ($db_conns[$_key]['db']) ?? ($db_conns[$_key]['db base']) ?? ($db_conns[$_key]['db_base']) ?? ($db_conns[$_key]['base']) ?? ($db_conns[3]) ?? null;//conncection database
			  $conn_info=array(//if a singular connection info is provided
		       'host'=>$dbc_host, 'user'=>$dbc_user,
		       'pass'=>$dbc_pass, 'base'=>$dbc_base
		      );
			 }
			 else{//addition (signular non-cluseted; )
			 }
			$this->__info['database']['sql'][$conn_info['base']] = $conn_info;//storage
		   }
		   else{
			$conn_info=array(//if a singular connection info is provided
		     'host'=>$db_host, 'user'=>$db_user,
		     'pass'=>$db_pass, 'base'=>$db_base
		    );
			$this->__info['database']['sql'][$conn_info['base']] = $conn_info;//stores the db connection info
		   }
		 }
	   //
		//attribute/parameters set
		 //language
		  $this->_rsrc['language']=$u_lang;//user language set
		  $lang_set=$this->_lang(array( 'obj'=>'_load', 'lang'=>$this->_rsrc['language'], 'trail'=>$_trail ));//loads the language file
		   if($lang_set===true){ $this->_lang=&$this->_rsrc['_lang']; }//sets a top level attribute as a reference to the language bank
		 //database
		  $conn_list=&$this->__info['database']['sql'];//get the list of the database connections
		   if(empty($conn_list)||(is_array($conn_list)&&count($conn_list)<=0)){ $conn_list=array(//defaults to the default connection if none provided
		    'host'=> $this->__defaults['_db']['host'], 'user'=> $this->__defaults['_db']['user'],
		    'pass'=> $this->__defaults['_db']['pass'], 'base'=> $this->__defaults['_db']['base']
		   ); }
		  foreach($conn_list as$dbCon_i=>$dbCon_v){//loops through the connection list
		   $d__b=new mysqli($dbCon_v['host'], $dbCon_v['user'], $dbCon_v['pass'], $dbCon_v['base']);//creates a new mysqli connection
		   $this->_rsrc['_streams']['sql'][$dbCon_v['base']] =& $d__b;
		  }
		  $this->_sql=&$this->_rsrc['_streams']['sql'];//refereces the sql tree
		  //info
		   $this->__info['database']['sql']=$conn_info;//stores the connection info
		   if(empty($this->__info['database']['_current'])){//if there is no current database connection
			$this->__info['database']['_current']=$db_base;//stores the connection name (database name) in the current string
		   }
	    parent::__construct($__ap);//calls the parent construction method
	  }
   }
  }
?>