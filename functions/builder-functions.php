<?php
// This is Ugly backwards Code

function season_select($season='0')
{
	switch($season)
	{
		case '0':
			$season_select= "<p><a href='?s=1'>Season 1</a> | <a href='?s=2'>Season 2</a> | <a href='?s=2p5'>Season 2.5</a> | <a href='?s=3'>Season 3</a> | All Seasons</p>\n";
			break;
		case '1':
			$season_select= "<p>Season 1 | <a href='?s=2'>Season 2</a> | <a href='?s=2p5'>Season 2.5</a> | <a href='?s=3'>Season 3</a> | <a href='?s=0'>All Seasons</a></p>\n";
			break;
		case '2':
			$season_select= "<p><a href='?s=1'>Season 1</a> | Season 2 | <a href='?s=2p5'>Season 2.5</a> | <a href='?s=3'>Season 3</a> | <a href='?s=0'>All Seasons</a></p>\n";
			break;
		case'2p5':
			$season_select= "<p><a href='?s=1'>Season 1</a> | <a href='?s=2'>Season 2</a> | Season 2.5 | <a href='?s=3'>Season 3</a> | <a href='?s=0'>All Seasons</a></p>\n";
			break;
		case '3':
		default:
			$season_select= "<p><a href='?s=1'>Season 1</a> | <a href='?s=2'>Season 2</a> | <a href='?s=2p5'>Season 2.5</a> | Season 3 | <a href='?s=0'>All Seasons</a></p>\n";
			break;
	}
	return $season_select;
}
function season_select_creator_page($season='2p5',$page)
{
	switch($season)
	{
		case '0':
			$season_select= "<p><a href='?action=single&$page&s=1'>Season 1</a> | <a href='?action=single&$page&s=2'>Season 2</a> | <a href='?action=single&$page&s=2p5'>Season 2.5</a> | <a href='?action=single&$page&s=3'>Season 3</a> | All Seasons</p>\n";
			break;
		case '1':
			$season_select= "<p>Season 1 | <a href='?action=single&$page&s=2'>Season 2</a> | <a href='?action=single&$page&s=2p5'>Season 2.5</a> | <a href='?action=single&$page&s=3'>Season 3</a> | <a href='?action=single&$page&s=0'>All Seasons</a></p>\n";
			break;
		case '2':
			$season_select= "<p><a href='?action=single&$page&s=1'>Season 1</a> | Season 2 | <a href='?action=single&$page&s=2p5'>Season 2.5</a> | <a href='?action=single&$page&s=3'>Season 3</a> | <a href='?action=single&$page&s=0'>All Seasons</a></p>\n";
			break;
		case '2p5':
			$season_select= "<p><a href='?action=single&$page&s=1'>Season 1</a> | <a href='?action=single&$page&s=2'>Season 2</a> |	Season 2.5 | <a href='?action=single&$page&s=3'>Season 3</a> | <a href='?action=single&$page&s=0'>All Seasons</a></p>\n";
			break;
		case '3':
		default:
			$season_select= "<p><a href='?action=single&$page&s=1'>Season 1</a> | <a href='?action=single&$page&s=2'>Season 2</a> |	<a href='?action=single&$page&s=2p5'>Season 2.5</a> | Season 3 | <a href='?action=single&$page&s=0'>All Seasons</a></p>\n";
			break;
	}
	return $season_select;
}
?>