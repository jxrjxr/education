<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Input;
use Session;
use App\Extra\SMS;
use App\Models\City as CityM;
use App\Models\Student as StudentM;

class Student extends Controller
{
    public $grade = [
        'primary_one' => '小学一年级',
        'primary_two' => '小学二年级',
        'primary_three' => '小学三年级',
        'primary_four' => '小学四年级',
        'primary_five' => '小学五年级',
        'primary_six' => '小学六年级',
        'junior_one' => '初中一年级',
        'junior_two' => '初中二年级',
        'junior_three' => '初中三年级',
        'senior_one' => '高中一年级',
        'senior_two' => '高中二年级',
        'senior_three' => '高中三年级'
    ];

    public $addresses = [
        1 => '北京',
        2 => '南京',
        3 => '上海',
        4 => '其他'
    ];

    public function add()
    {
        //$cityArr = CM::lists('name','id')->toArray();
        //return view('student.add',['cityArr'=>$cityArr]);
        return view('student.add',['grade'=>$this->grade,'addresses'=>$this->addresses]);
    }

    public function store()
    {
        $params = Input::all();
        $params['password'] = md5(substr($params['mobile'], -4));
        $student = StudentM::create($params);
        if ($student) return $this->detail($student->id)->with('success', '新增成功');
    }

    public function detail($id)
    {
        $student = StudentM::find($id);
        return view('student.detail',['student'=>$student,'addresses'=>$this->addresses,'grade'=>$this->grade]);
    }

    public function update()
    {
        $params = Input::all();
        $user = UM::find($params['id']);
        $user->update($params);
        if ($user) return $this->detail($user->id)->with('success', '修改成功');
    }

    public function auth()
    {
        $params = Input::all();
        $user = UM::find($params['id']);
        if ( $user->update(['status'=>$params['status']]) ) {
            return 1;
        }
        return 0;
    }

    public function lists()
    {
        $keyword = Input::get('keyword');
        if (isset($keyword) && !empty($keyword)){
            $lists = StudentM::where('username','like','%'.$keyword.'%')
                        ->orWhere('mobile','like','%'.$keyword.'%')
                        ->get();
        } else {
            $lists = StudentM::get();
        }
        return view('student.lists',['lists'=>$lists,'addresses'=>$this->addresses,'grade'=>$this->grade]);
    }

    public function show($id)
    {
        $user = UM::find($id);
        $cityArr = CM::lists('name','id')->toArray();
        isset($user->city_id) && $user->city = $cityArr[$user->city_id];
        return view('user.show',['user'=>$user,'addresses'=>$this->addresses,'grade'=>$this->grade]);
    }

    public function search()
    {
        $keyword = Input::get('keyword');
        if (isset($keyword) && !empty($keyword)){
            $lists = UM::where('name','like','%'.$keyword.'%')
                ->orWhere('nickname','like','%'.$keyword.'%')
                ->orWhere('mobile','like','%'.$keyword.'%')
                ->orWhere('idcard','like','%'.$keyword.'%')
                ->get();
        } else {
            $lists = UM::get();
        }
        return view('user.search',['lists'=>$lists]);
    }

    public function  score()
    {
        echo "暂无";
    }

    public function  sms()
    {
        $user_id = Input::get('id');
        $user = UM::find($user_id);
        return true;
        SMS::send(LTM::SMS_AUTH_ID, $user->mobile,'111');
    }


}