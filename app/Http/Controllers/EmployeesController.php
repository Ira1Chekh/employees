<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Department;
use App\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        if(\request()->has('size'))
            $employees = Employee::paginate(\request('size'))->appends('size', \request('size'));
        else
            $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function show($department){
        $employees = Employee::where('department_id', $department)->paginate(10);
        $selectedDepartment = Department::findOrFail($department);
        return view('employees.show', compact('employees', 'selectedDepartment'));
    }

    public function upload(){
        return view('employees.upload');
    }

    public function store(Request $request){
        $upload = null;
        $upload = $request->file('upload-file');
        if($upload == null || $upload->getClientOriginalExtension() != 'xml')
            return redirect()->back()->with('status', 'Загрузите файл с расширением xml');

        $filePath = $upload->getRealPath();
        $employees = simplexml_load_file($filePath) or die("Не удалось открыть файл");
        foreach ($employees->children() as $row) {
            $last_name = $row->last_name;
            $first_name = $row->first_name;
            $patronymic = $row->patronymic;
            $date_of_birth = $row->date_of_birth;
            $department_id = $row->department_id;
            $job_position = $row->job_position;
            $type = $row->type;
            if($type == 1){
                $monthly_rate = $row->monthly_rate;
                $hours = 0;
                $hourly_rate = 0;
            }
            else if($type == 0){
                $monthly_rate = 0;
                $hours = $row->hours;
                $hourly_rate = $row->hourly_rate;
            }
            $data = array('last_name' => $last_name, 'first_name' => $first_name,
                'patronymic' => $patronymic, 'date_of_birth' => $date_of_birth,
                'department_id' => $department_id, 'job_position' => $job_position,
                'type' => $type, 'monthly_rate' => $monthly_rate, 'hours' => $hours,
                'hourly_rate' => $hourly_rate);
            DB::table('employees')->insert($data);
        }
        return redirect('/employees');
    }
}
