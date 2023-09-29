<?php
require_once('includes/connect.php');

define('DEFAULT_SEASON','2');

function get_tod_list()
{
	$db = createConnection();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from tod;";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $list;
}
function get_tod_list_by_parent($parent)
{
	$db = createConnection();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from tod where parent=:parent order by date desc;";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':parent', $parent); 
	$stmt->execute();
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $list;
}
function get_tod_by_id($id)
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "select * from tod where id=:id;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':id', $id); 
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function search_tod($search_str)
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
	
	$sql = "SELECT * FROM tod WHERE task like :search or challenge like :search2 or person like :search3 ORDER BY person ASC";
		
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':search', "%".$search_str."%"); 
	$stmt->bindValue(':search2', "%".$search_str."%"); 
	$stmt->bindValue(':search3', "%".$search_str."%"); 
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function add_tod($parent, $character, $date, $type, $task, $challenge, $content)
{
	$db = createConnection();

	$sql= 'INSERT INTO tod (parent, person, date, type, task, challenge, content, season) VALUES (:parent, :character,:date, :type, :task, :challenge,:content,:season);';
	
	$stmt = $db->prepare($sql);
		
	$stmt->bindValue(':parent', $parent);
	$stmt->bindValue(':character', $character); 
	$stmt->bindValue(':date', $date); 
	$stmt->bindValue(':type', $type); 
	$stmt->bindValue(':task', $task); 
	$stmt->bindValue(':challenge', $challenge); 
	$stmt->bindValue(':content', $content);
	$stmt->bindValue(':season', DEFAULT_SEASON);
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
} 
function update_tod($id, $parent, $character, $date, $type, $task, $challenge, $content, $season=DEFAULT_SEASON)
{
	$db = createConnection();

	$sql= 'Update tod set 
			parent=:parent, 
			person=:character, 
			date=:date, 
			type=:type, 
			task=:task, 
			challenge=:challenge, 
			content=:content, 
			season=:season
		WHERE id=:id
		;';
	
	$stmt = $db->prepare($sql);
		
	$stmt->bindValue(':id', $id);
	$stmt->bindValue(':parent', $parent);
	$stmt->bindValue(':character', $character); 
	$stmt->bindValue(':date', $date); 
	$stmt->bindValue(':type', $type); 
	$stmt->bindValue(':task', $task); 
	$stmt->bindValue(':challenge', $challenge); 
	$stmt->bindValue(':content', $content);
	$stmt->bindValue(':season', $season);
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
} 
?>
