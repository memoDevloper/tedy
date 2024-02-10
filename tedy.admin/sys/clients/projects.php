
<div class="row" >
	<div class="col-md-12">
		<div class="panel-group" id="projectsStatusAccordion" aria-multiselectable="true" role="tablist">
			<div class="panel">
				<?php
				$todayNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.client' => $dir5],
					'eog' => ['A.deadline' => $wam->act->makeTimeSD(date('Y-m-d', $time))],
					'eol' => ['A.deadline' => $wam->act->makeTimeED(date('Y-m-d', $time))],
				]);
				?>
				<div class="panel-heading" id="todayHeading" role="tab"><a class="panel-title" data-toggle="collapse" href="#todayCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="todayCollapse">Today (<?php echo $todayNum ?>)</a> </div>
				<div class="panel-collapse collapse in" id="todayCollapse" aria-labelledby="todayHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.client' => $dir5],
								'eog' => ['A.deadline' => $wam->act->makeTimeSD(date('Y-m-d', $time))],
								'eol' => ['A.deadline' => $wam->act->makeTimeED(date('Y-m-d', $time))],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in Today Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="panel">
				<?php
				$amendNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.status' => 2, 'A.client' => $dir5],
				]);
				?>
				<div class="panel-heading" id="amendHeading" role="tab"><a class="panel-title collapsed" data-toggle="collapse" href="#amendCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="amendCollapse">Amend (<?php echo $amendNum ?>)</a> </div>
				<div class="panel-collapse collapse" id="amendCollapse" aria-labelledby="amendHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.status' => 2, 'A.client' => $dir5],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in Amend Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="panel">
				<?php
				$newNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.is_distributed' => 0, 'A.client' => $dir5],
				]);
				?>
				<div class="panel-heading" id="newHeading" role="tab"><a class="panel-title collapsed" data-toggle="collapse" href="#newCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="newCollapse">New (<?php echo $newNum ?>)</a> </div>
				<div class="panel-collapse collapse" id="newCollapse" aria-labelledby="newHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.is_distributed' => 0, 'A.client' => $dir5],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in New Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="panel">
				<?php
				$underProcessNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.is_distributed' => 1, 'A.client' => $dir5],
					'not' => ['A.status' => [1, 2, 3, 4]]
				]);
				?>
				<div class="panel-heading" id="underProcessHeading" role="tab"><a class="panel-title collapsed" data-toggle="collapse" href="#underProcessCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="underProcessCollapse">Under Process (<?php echo $underProcessNum ?>)</a> </div>
				<div class="panel-collapse collapse" id="underProcessCollapse" aria-labelledby="underProcessHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.is_distributed' => 1, 'A.client' => $dir5],
								'not' => ['A.status' => [1, 2, 3, 4]],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in Under Process Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="panel">
				<?php
				$tempNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.status' => 4, 'A.client' => $dir5]
				]);
				?>
				<div class="panel-heading" id="tempHeading" role="tab"><a class="panel-title collapsed" data-toggle="collapse" href="#tempCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="tempCollapse">Temp (<?php echo $tempNum ?>)</a> </div>
				<div class="panel-collapse collapse" id="tempCollapse" aria-labelledby="tempHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.status' => 4, 'A.client' => $dir5],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in Temp Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="panel">
				<?php
				$doneNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.status' => 1, 'A.client' => $dir5]
				]);
				?>
				<div class="panel-heading" id="doneHeading" role="tab"><a class="panel-title collapsed" data-toggle="collapse" href="#doneCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="doneCollapse">Done (<?php echo $doneNum ?>)</a> </div>
				<div class="panel-collapse collapse" id="doneCollapse" aria-labelledby="doneHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.status' => 1, 'A.client' => $dir5],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in Done Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="panel">
				<?php
				$pendingNum = $wam->dbm->rows('projects A', [
					'eq' => ['A.status' => 3, 'A.client' => $dir5]
				]);
				?>
				<div class="panel-heading" id="pendingHeading" role="tab"><a class="panel-title collapsed" data-toggle="collapse" href="#pendingCollapse" data-parent="#projectsStatusAccordion" aria-expanded="true" aria-controls="pendingCollapse">Pending (<?php echo $pendingNum ?>)</a> </div>
				<div class="panel-collapse collapse" id="pendingCollapse" aria-labelledby="pendingHeading" role="tabpanel">
					<div class="panel-body">
						<?php
						if(
							$files = $wam->dbm->getData('projects A', [
								'A.id',
								'A.client',
								'(SELECT name FROM clients WHERE id = A.client) as client_name',
								'(SELECT lastname FROM clients WHERE id = A.client) as client_lastname',
								'A.deadline',
								'A.translators',
								'A.direction',
								'A.status',
								'A.pages',
								'A.name',
							], [
								'eq' => ['A.status' => 3, 'A.client' => $dir5],
								'order' => ['A.deadline DESC'],
							])
						){
							?>
							<div class="table-responsive">
								<table class="table table-hover manage-u-table">
									<thead>
										<tr>
											<th>CODE</th>
											<th>MANAGER</th>
											<th>CLIENT</th>
											<th>DEADLINE</th>
											<th>TARGET</th>
											<th>PAGES</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($files as $key => $file) {
											?>
											<tr class="item" >
												<td>
													<a href="/files/open/<?php echo $file->name; ?>" class="CPB" >
														<?php
														$name_parts = explode('-', $file->name);
														$name = $name_parts[0];
														$name .= "-";
														$name .= substr($name_parts[1], 0, 4);
														$dayname = substr($name_parts[1], 4, 5);
														$name .= substr_replace($name_parts[1], "<span style='color: red' >$dayname", 0);
														$name .= "-$name_parts[2]</span>";
														echo $name
														?>
													</a>
													<a href="#" data-file="<?php echo $file->name; ?>" data-toggle="tooltip" title="Copy File Code to Clipboard" ><i class="fa fa-clipboard"></i></a>
												</td>
												<td>
													<?php
													$translators = explode('[//]', $file->translators);
													foreach ($translators as $key => $translator) {
														$translator_id = str_replace(['[', ']'], ['', ''], $translator);
														$translator = $wam->dbm->getData('users', ['name', 'lastname'], ['eq' => ['id' => $translator_id]]);
														$translator = $translator[0];
														?>
														<?php echo $translator->name ?> <?php echo $translator->lastname ?><br />
														<?php
													}
													?>
												</td>
												<td><?php echo $file->client_name ?> <?php echo $file->client_lastname ?></td>
												<td><?php echo date('Y-m-d h:I A', $file->deadline); ?></td>
												<td><?php echo strtoupper($file->direction) ?></td>
												<td><?php echo $file->pages ?></td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						}else{
							?>
							<h4>No Projects in Pending Section</h4>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>