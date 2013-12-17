<table>
<?php
	foreach($possibleDirectors as $pd) {
		echo '<tr>',
			'<td>',
				$pd['CampDirector']['name'],
			'</td>',
			'<td>',
				$this->Form->postLink('Set as director', array(
					'action'=>'setDirector', $camp['Camp']['id'], $pd['CampDirector']['id']
				)),
			'</td>',
		'</tr>';
	}
?>
</table>	
