<?php

namespace app\branchadmin\model;

use think\Model;

class DangyuanJobidBranchsid extends Model
{
    //
    //
    // 公共的通过branchs_id 党组织id获取对应党组织下面所有的行政职称称呼
    public static function branchsIdJobnames($branchsid)
    {
    	$data = self::where('branchs_id',$branchsid)->find();
    	if (empty($data)) {
    		return ;
    	}
		$job_ids = $data->job_ids;
	    $jobsname = model('DangyuanJobname')
	             ->where('id','in',$job_ids)
	             ->select();
	    return $jobsname;
    }
}
