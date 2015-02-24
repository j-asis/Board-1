<?php

class Thread extends AppModel                    
{

//Thread Creation
public $validation = array(
       'title' => array(
            'length' => array(            
               'validate_between', 1, 30,
       		     ),        
       		 ),
    	);


 public function create(Comment $comment){
        $this->validate();
        $comment->validate();
        
	if ($this->hasError() || $comment->hasError()) {                    
           throw new ValidationException('Invalid thread or comment');
        }
                    
       $db = DB::conn();
       $db->begin();

       $date_created = date("Y-m-d H:i:s");
       $params = array(
		 'title' => $this->title,
		 'created'=> $date_created
		 );	

       $db->insert('thread', $params);
       $this->id = $db->lastInsertId(); //returns the latest inserted id
       $this->write($comment); //write first comment at the same time

       $db->commit();
    }

//Add a thread model
public static function getAll(){
	$threads = array();
        $db = DB::conn();
	$rows = $db->rows('SELECT * FROM thread');
        
        foreach ($rows as $row) {                    
           $threads[] = new Thread($row);
           }
                    
return $threads;
}            

//Display the title of the selected thread
public static function get($id){
    $db = DB::conn();
    $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

	if(!$row) {
            throw new RecordNotFoundException('no record found');
        }	

return new self($row);    
}

public function getComments() {
        $comments = array();       
        $db = DB::conn();

        $rows = $db->rows(
        'SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC', array($this->id));
                    
           foreach ($rows as $row) {                        
              $comments[] = new Comment($row);
           }   
                    
	return $comments;
	}	


 public function write(Comment $comment) {
	if (!$comment->validate()) {
           throw new ValidationException("invalid comment");
        }

	$db = DB::conn();
	$db->query(
         'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()',
           array($this->id, $comment->username, $comment->body)
        );
           
    }

}		
   
?>
