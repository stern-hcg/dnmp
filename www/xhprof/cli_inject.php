<?php 

if (getenv('XHPROF') != '' ){
    $xhprof = true;
} else {
    $xhprof = false;
}


if($xhprof){
	
	xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS);
	register_shutdown_function(function() {
		$xhprof_data = xhprof_disable();
		include_once dirname(__FILE__) . "/xhprof_lib/utils/xhprof_lib.php";
		include_once dirname(__FILE__) . "/xhprof_lib/utils/xhprof_runs.php";

		$objXhprofRun = new XHProfRuns_Default();

		$request_uri = str_replace(['/','.'],'_',$_SERVER["PHP_SELF"]);
		$method = $request_uri;
		$run_id = date('YmdHis',time());

		$run = $objXhprofRun->save_run($xhprof_data, $method, $run_id);
	});
}

