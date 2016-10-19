<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use App\Http\Requests\StoreNews;
use App\News;
use App\Teacher;
use Auth;

class PortalNoticiasData extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
     * Store a new user.
     *
     * @param  Request  $r
     * @return Response
     */
	function main(Request $r) {
		$ret = array(
			'err' => 0,
			'msg' => 'messages.aprov.uer',
		);
		if ( !isset($r['id']) ) {
			$ret['err'] = 1;
			$ret['msg'] = 'messages.aprov.idn';
		} else {
			$ret['err'] = 0;
			$id = intval( $r['id'] );
			$not = News::where('id',$id)->first();
			$ret['not'] = array(
				'name' => $not['title'],
				'desc' => $not['subtitle'],
				'text' => $not['text'],
			);
		}
		return $ret;
	}
}
