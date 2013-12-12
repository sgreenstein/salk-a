<table>
<?php
	foreach($possibleDirectors as $pd) {
		echo '<tr>',
			'<td>',
				$pd['SiteDirector']['name'],
			'</td>',
			'<td>',
				$this->Form->postLink('Set as director', array(
					'action'=>'setDirector', $site['Site']['id'], $pd['SiteDirector']['id']
				)),
			'</td>',
		'</tr>';
	}
?>
</table>	
