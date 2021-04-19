<?php 

if(isset($_SERVER['REQUEST_URI']) && preg_match('/xhprof.*/',$_SERVER['REQUEST_URI'])){
    $xhprof = true;
}else{
    $xhprof = false;
}

if($xhprof){
    $request_uri = explode('?', $_SERVER["REQUEST_URI"]);
	
	xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS);
	register_shutdown_function(function() {
		$xhprof_data = xhprof_disable();
		if (function_exists('fastcgi_finish_request')) {
			fastcgi_finish_request();
		}

		include_once dirname(__FILE__) . "/xhprof_lib/utils/xhprof_lib.php";
		include_once dirname(__FILE__) . "/xhprof_lib/utils/xhprof_runs.php";

		$objXhprofRun = new XHProfRuns_Default();

		$request = explode('?', $_SERVER["REQUEST_URI"]);
		$request_route = explode('/', $request[0]);
		$method = $request_route[2];
		$run_id = date('YmdHis',time());

		$run = $objXhprofRun->save_run($xhprof_data, $method, $run_id);
	});
}

