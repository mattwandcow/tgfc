<?php
require_once('includes/connect.php');

define('DEFAULT_SEASON','3');

function get_all_characters()
{
	$db = createConnection();
	$sql = 'SELECT ch.character_id as character_id, ch.name as character_name, cr.name as creator_name,
				ch.species as species, ch.open as open, count(tag) as ch_tags, ch.season as season,
				ch.secrets as secrets, cr.creator_id as creator_id
				FROM characters ch 
				join creators cr on ch.fk_creator_id=cr.creator_id 
				left outer join tags t on t.fk_character_id = ch.character_id
				GROUP BY ch.character_id
				ORDER BY ch.name asc
				;';
	
	$stmt = $db->prepare($sql);
		
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_all_characters_by_season($season)
{
	$db = createConnection();
	$sql = 'SELECT ch.character_id as character_id, ch.name as character_name, cr.name as creator_name,
				ch.species as species, ch.open as open, count(tag) as ch_tags, ch.season as season,
				ch.secrets as secrets, cr.creator_id as creator_id
				FROM characters ch 
				join creators cr on ch.fk_creator_id=cr.creator_id 
				left outer join tags t on t.fk_character_id = ch.character_id
				WHERE season=:season_var
				GROUP BY ch.character_id
				ORDER BY ch.name asc
				;';
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':season_var', $season); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_creator_by_id($crid)
{
	$db = createConnection();
	$sql = 'SELECT * from creators where creator_id = :crid;';
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_characters_by_creator_and_season($crid, $season)
{
	$db = createConnection();

	if($season=='0')
	{
	$sql = 'SELECT * FROM characters where fk_creator_id=:crid ORDER BY name asc;';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	}
	else
	{
	$sql = 'SELECT * FROM characters where fk_creator_id=:crid and season=:season_var ORDER BY name asc;';	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->bindValue(':season_var', $season); 
	}
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_characters_by_creator($crid)
{
	$db = createConnection();
	$sql = 'SELECT * FROM characters where fk_creator_id=:crid ORDER BY name asc;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_character_by_id($crid)
{
	$db = createConnection();
	$sql = 'SELECT ch.name as character_name, ch.character_id as character_id, cr.name as creator_name, cr.creator_id as creator_id,
				ch.species as species, ch.gender as gender, ch.text as text, ch.link as link, ch.open as open, ch.season as season, 
				ch.secrets as secrets, ch.forbiddens as forbiddens
				FROM characters ch join creators cr on cr.creator_id=ch.fk_creator_id
				where character_id=:crid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;
	return $list;

}
function get_creators_by_season($season=DEFAULT_SEASON)
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT 
				a.creator_id as cre_id, a.name as cre_name, a.bday as cre_bday, a.joined as cre_join, count(c.character_id) as cre_count 
				FROM creators a 
				left outer join characters c on c.fk_creator_id=a.creator_id 
				where c.season=:season 
				group by a.creator_id 
				order by a.name asc;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':season', $season); 
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function get_all_creators()
{

	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT 
				a.creator_id as cre_id, a.name as cre_name, a.bday as cre_bday, a.joined as cre_join, count(c.character_id) as cre_count 
				FROM creators a 
				left outer join characters c on c.fk_creator_id=a.creator_id 
				group by a.creator_id 
				order by a.name asc;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function update_creator($crid, $name, $joined, $bday, $link)
{
	//echo $name;
	$db = createConnection();
	$sql = 'UPDATE creators SET 
				name = :name,
				joined = :joined,
				bday = :bday,
				link = :link
				WHERE creator_id=:crid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->bindValue(':name', $name); 
	$stmt->bindValue(':joined', $joined); 
	$stmt->bindValue(':bday', $bday); 
	$stmt->bindValue(':link', $link); 
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function update_character($chid, $crid, $name, $species, $gender, $open, $text, $link, $forb, $secr)
{
	$db = createConnection();
	$sql = 'UPDATE characters SET 
				fk_creator_id = :crid,
				name = :name,
				species = :species,
				gender = :gender,
				open = :open,
				text = :text,
				link = :link,
				forbiddens = :forb,
				secrets = :secr
				WHERE character_id=:chid;';
				
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->bindValue(':name', $name); 
	$stmt->bindValue(':species', $species); 
	$stmt->bindValue(':gender', $gender); 
	$stmt->bindValue(':open', $open); 
	$stmt->bindValue(':text', $text); 
	$stmt->bindValue(':link', $link); 
	$stmt->bindValue(':forb', $forb); 
	$stmt->bindValue(':secr', $secr); 
	
	$stmt->execute();
	
	$stmt->closeCursor();
	
	return $list;
}
function get_ksk_by_character_id($chid)
{
	$db = createConnection();
	$sql = 'SELECT *
				FROM ksk_codes kc 
				where character_id=:chid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;
}
function get_ksk_by_id($kcid)
{
	$db = createConnection();
	$sql = 'SELECT *
				FROM ksk_codes kc 
				where id=:kcid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':kcid', $kcid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;
}
function update_ksk($kcid, $ksk_chid, $ksk_title, $ksk_code, $ksk_cr, $ksk_desc)
{
	$db = createConnection();
	$sql = 'UPDATE ksk_codes SET 
				character_id = :ksk_chid,
				ksk_title = :ksk_title,
				ksk = :ksk_code,
				code_creator = :ksk_cr,
				description = :ksk_desc
				WHERE id=:kcid;';
				
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':kcid', $kcid, PDO::PARAM_INT); 
	$stmt->bindValue(':ksk_chid', $ksk_chid, PDO::PARAM_INT); 
	$stmt->bindValue(':ksk_title', $ksk_title); 
	$stmt->bindValue(':ksk_code', $ksk_code); 
	$stmt->bindValue(':ksk_cr', $ksk_cr, PDO::PARAM_INT); 
	$stmt->bindValue(':ksk_desc', $ksk_desc);
	
	$stmt->execute();
	
	$stmt->closeCursor();
	
	return $list;
}
function get_alts_by_character_id($chid)
{
	$db = createConnection();
	$sql = 'SELECT *
				FROM alts a 
				WHERE fk_character_id=:chid
				ORDER BY event;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;
}
function get_tags_by_character_id($chid)
{
	$db = createConnection();
	$sql = 'SELECT *
				FROM tags a 
				where fk_character_id=:chid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;
}
function add_new_character($crid, $chname, $chgend, $chspec, $chopen, $chforb, $chsecr, $chdesc, $chlink, $season)
{
	$db = createConnection();
	$sql = 'INSERT into characters(fk_creator_id, name, gender, species, text, link, open, season, forbiddens, secrets)
				values
				(:crid, :chname, :chgend, :chspec, :chdesc, :chlink, :chopen, :season, :chforb, :chsecr);';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->bindValue(':chname', $chname); 
	$stmt->bindValue(':chgend', $chgend); 
	$stmt->bindValue(':chspec', $chspec); 
	$stmt->bindValue(':chopen', $chopen); 
	$stmt->bindValue(':chforb', $chforb); 
	$stmt->bindValue(':chsecr', $chsecr); 
	$stmt->bindValue(':chdesc', $chdesc); 
	$stmt->bindValue(':chlink', $chlink); 
	$stmt->bindValue(':season', $season); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
}
function add_alt_card($chid, $name, $event, $link)
{
	$db = createConnection();
	$sql = 'INSERT into alts(fk_character_id, name, event, link)
				values
				(:chid, :chname, :chevent, :chlink);';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->bindValue(':chname', $name); 
	$stmt->bindValue(':chevent', $event); 
	$stmt->bindValue(':chlink', $link); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
}
function add_new_creator($name, $bday, $join, $link)
{
	$db = createConnection();
	$sql = 'INSERT into creators(name, bday, joined, link)
				values
				(:name, :bday, :join, :link);';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':name', $name); 
	$stmt->bindValue(':bday', $bday); 
	$stmt->bindValue(':join', $join); 
	$stmt->bindValue(':link', $link); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
}
function add_statics($chid, $name, $event, $link)
{
	$db = createConnection();
	$sql = 'INSERT into statics(fk_creator_id, name, event, link)
				values
				(:chid, :chname, :chevent, :chlink);';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->bindValue(':chname', $name); 
	$stmt->bindValue(':chevent', $event); 
	$stmt->bindValue(':chlink', $link); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
}
function get_statics_by_creator_id($chid)
{
	$db = createConnection();
	$sql = 'SELECT *
				FROM statics a 
				where fk_creator_id=:chid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;
}
function get_static_by_id($stid)
{
	$db = createConnection();
	$sql = 'SELECT *
				FROM statics where statics_id=:stid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':stid', $stid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $list;

}
function update_static($stid, $crid, $name, $event, $link)
{
	$db = createConnection();
	$sql = 'UPDATE statics SET 
				fk_creator_id = :crid,
				name = :name,
				event = :event,
				link = :link
				WHERE statics_id=:stid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':stid', $stid, PDO::PARAM_INT); 
	$stmt->bindValue(':crid', $crid, PDO::PARAM_INT); 
	$stmt->bindValue(':name', $name); 
	$stmt->bindValue(':event', $event);
	$stmt->bindValue(':link', $link); 
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_alt_by_id($aid)
{
	$db = createConnection();
	$sql = 'SELECT * from alts where alts_id = :aid;';
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':aid', $aid, PDO::PARAM_INT); 
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
}
function update_alt($aid, $chid, $name, $event, $link)
{
	$db = createConnection();
	$sql = 'UPDATE alts SET 
				fk_character_id = :chid,
				name = :name,
				event = :event,
				link = :link
				WHERE alts_id=:aid;';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':aid', $aid, PDO::PARAM_INT); 
	$stmt->bindValue(':chid', $chid, PDO::PARAM_INT); 
	$stmt->bindValue(':name', $name); 
	$stmt->bindValue(':event', $event);
	$stmt->bindValue(':link', $link); 
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC); 
	
	$stmt->closeCursor();
	
	return $list;
	
}
function get_alt_options()
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "select count(name) as count, event from alts group by event order by event;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function get_alts_by_event($event)
{
	$db = createConnection();
	$sql = 'SELECT * from alts where event like :event order by name;';
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':event', $event); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_statics_by_event($event)
{
	$db = createConnection();
	$sql = 'SELECT s.name as static_name, c.name as creator_name, c.creator_id as creator_id, s.link as link from statics s join creators c on c.creator_id=s.fk_creator_id where lower(s.event)=lower(:event) order by s.name;';
	
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':event', $event); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(); 
	
	$stmt->closeCursor();
	
	return $list;
}
function get_event_list()
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "select event, count(*) as count from statics group by event order by event;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function add_resource($name, $event, $link)
{
	$db = createConnection();
	$sql = 'INSERT into resources(name, event, link)
				values
				(:chname, :chevent, :chlink);';
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':chname', $name); 
	$stmt->bindValue(':chevent', $event); 
	$stmt->bindValue(':chlink', $link); 
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
	$stmt->closeCursor();
	
	return $db->lastInsertId();
} 
function get_resource_list()
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "select * from resources;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->execute();
	
	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function get_recent_character_id()
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT character_id FROM `characters` order by character_id desc limit 1;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list['character_id'];
}
function get_recent_creator_id()
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT creator_id FROM `creators` order by creator_id desc limit 1;";
	
	$stmt = $db->prepare($sql);
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list['creator_id'];
}
function set_user_password($user, $password)
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "UPDATE`user` SET password=:pass WHERE username=:user";
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':user', $user); 
	$stmt->bindValue(':pass', $password); 
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
function get_user_login($user)
{
	$db = createConnection();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "SELECT * FROM `user` WHERE username=:user";
	
	$stmt = $db->prepare($sql);
	
	$stmt->bindValue(':user', $user); 
	
	$stmt->execute();
	
	$list = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$stmt->closeCursor();
	
	return $list;
}
?>
