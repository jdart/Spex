<?php

class SpexProfiler extends WireData
{
	private $eventStack;
	private $eventHistory;
	private $firstTime;

	public function start($name)
	{
		if ( ! $this->config->debug)
			return;

		if ( ! isset($this->firstTime))
			$this->firstTime = microtime(TRUE);

		$this->eventStack[] = array(
			'name' => $name, 
			'mtime' => microtime(TRUE), 
			'queries' => static::getQueryCount(),
			'memory' => memory_get_peak_usage(TRUE)
		);
	}

	public function getQueryCount()
	{
		return count($this->database->getQueryLog());
	}

	public function stop()
	{
		if ( ! $this->config->debug)
			return;

		$last = array_pop($this->eventStack);

		$last['mtime'] = microtime(TRUE) - $last['mtime'];
		$last['queries'] = $this->getQueryCount() - $last['queries'];
		$last['memory'] = memory_get_peak_usage(TRUE) - $last['memory'];

		$this->eventHistory[] = $last;
	}

	public function render()
	{
		if ( ! $this->config->debug)
			return '';

		ob_start(); ?>
<style>
.profiler {
	position: fixed;
	bottom: 0;
	right: 0;
	z-index: 9999;
}
.profiler td, .profiler th {
	text-align: right;
	border-left: 1px solid #cbcbcb;/*  inner column border */
	border-width: 0 0 0 1px;
	font-size: inherit;
	margin: 0;
	overflow: visible; /*to make ths where the title is really long work*/
	padding: 0.5em 1em; /* cell padding */
}
.profiler .name {
	text-align: left;
}
.profiler table {
	border-collapse: collapse;
	border-spacing: 0;
	empty-cells: show;
	border: 1px solid #cbcbcb;
}
.profiler td:first-child,
.profiler th:first-child {
	border-left-width: 0;
}
.profiler thead {
	background: #e0e0e0;
	color: #000;
	text-align: left;
	vertical-align: bottom;
}
.profiler td {
	background-color: transparent;
}
.profiler tr td {
	background-color: #fff;
}
.profiler tr:nth-child(2n-1) td {
	background-color: #f2f2f2;
}
.profiler td {
	border-bottom: 1px solid #cbcbcb;
}
.profiler tbody > tr:last-child td,
.profiler tbody > tr:last-child td {
	border-bottom-width: 0;
}
.profiler td,
.profiler th {
	border-width: 0 0 1px 0;
	border-bottom: 1px solid #cbcbcb;
}
.profiler tbody > tr:last-child td {
	border-bottom-width: 0;
}
.profiler .total {
	font-weight: bold;
}
.profiler .summary {
	width: 100%;
	display: none;
}
.profiler.closed .summary {
	display: block;
}
.profiler.closed .detail {
	display: none;
}
</style>
<script>
$(document).on('click', '.profiler a', function(e) {
	$('.profiler').toggleClass('closed');
	e.preventDefault();
});
</script>
<div class="profiler closed">
	<table class="detail">
		<thead>
			<tr>
				<th></th>
				<th>Time</th>
				<th>DB</th>
				<th>Mem</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->eventHistory as $event): ?>
				<tr>
					<td class="name"><?php echo $event['name'] ?></td>
					<td><?php echo number_format($event['mtime'], 3) ?>s</td>
					<td><?php echo $event['queries'] ?></td>
					<td><?php echo $this->formatBytes($event['memory']) ?></td>
				</tr>
			<?php endforeach ?>
			<tr class="total">
				<td><a href="#open">Toggle</a></td>
				<td><?php echo number_format(microtime(TRUE) - $this->firstTime, 3) ?>s</td>
				<td><?php echo $this->getQueryCount() ?> Queries</td>
				<td><?php echo $this->formatBytes(memory_get_peak_usage(TRUE)) ?></td>
			</tr>
		</tbody>
	</table>
	<table class="summary">
		<tr class="total">
			<td><a href="#open">Toggle</a></td>
			<td><?php echo number_format(microtime(TRUE) - $this->firstTime, 3) ?>s</td>
			<td><?php echo $this->getQueryCount() ?> Queries</td>
			<td><?php echo $this->formatBytes(memory_get_peak_usage(TRUE)) ?></td>
		</tr>
	</table>
</div>
<?php
		return ob_get_clean();
	}

	function formatBytes($B, $D=0) 
	{
		$S = 'KMGTPEZY';
		$F = floor((strlen($B) - 1) / 3);
		return sprintf("%.{$D}f", $B/pow(1024, $F)).' '.@$S[$F-1].'B';
	} 
}

