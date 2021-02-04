<?php
/*
	zrep-params.php

	Copyright (c) 2018 - 2021 Jose Rivera (JoseMR)
    All rights reserved.

	Portions of XigmaNAS® (https://www.xigmanas.com).
	Copyright (c) 2021 XigmaNAS® <info@xigmanas.com>.
	XigmaNAS® is a registered trademark of Michael Zoon (zoon01@xigmanas.com).
	All rights reserved.

	Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:

    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
    ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
    WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
    ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
    (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
    LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
    ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
    (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
    SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
require_once 'auth.inc';
require_once 'guiconfig.inc';

function zfs_get_zrep_list() {
	global $output;
	$cmd = 'zrep list -v 2>&1';
	unset($output);
	mwexec2($cmd,$output);
	if(empty($output)):
		$output = [gtext('No zrep parameters information available.')];
	endif;
	return implode(PHP_EOL,$output);
}

$pgtitle = [gtext("Extensions"), gtext('Zrep'),gtext('Parameters')];
include 'fbegin.inc';
$document = new co_DOMDocument();
$document->
	add_area_tabnav()->
		push()->
		add_tabnav_upper()->
			ins_tabnav_record('zrep-gui.php',gettext('Zrep'),gettext('Reload page'),true)->
			ins_tabnav_record('zrep-info.php',gettext('Parameters'),gettext('Reload page'),true)->
			ins_tabnav_record('zrep-params.php',gettext('Parameters'),gettext('Reload page'),true);
$document->render();
?>
<table id="area_data"><tbody><tr><td id="area_data_frame">
	<table class="area_data_settings">
		<colgroup>
			<col class="area_data_settings_col_tag">
			<col class="area_data_settings_col_data">
		</colgroup>
		<thead>
<?php
			html_titleline2(gettext('Zrep Parameters & Info'));
?>
		</thead>
		<tbody>
			<tr>
				<td class="celltag"><?=gtext('Parameters & Info');?></td>
				<td class="celldata">
					<pre><span id="zfs_zrep_list"><?=zfs_get_zrep_list();?></span></pre>
				</td>
			</tr>
		</tbody>
		<tfoot>
<?php
			html_separator2();
?>
		</tfoot>
	</table>
	<table class="area_data_settings">
		<colgroup>
			<col class="area_data_settings_col_tag">
			<col class="area_data_settings_col_data">
		</colgroup>
	</table>
</td></tr></tbody></table>
<?php
include 'fend.inc';
?>
