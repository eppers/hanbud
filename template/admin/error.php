{% set color = ['green','red','yellow','blue'] %}
				<!--  start message-yellow -->
				<div id="message-{{color[session.status]}}">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="{{color[session.status]}}-left">{{session.msg}}.</td>
					<td class="{{color[session.status]}}-right"><a class="close-{{color[session.status]}}"><img src="/public/admin/img/table/icon_close_{{color[session.status]}}.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-yellow -->                             

