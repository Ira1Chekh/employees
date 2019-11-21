@extends('layout')

@section('content')

    <h1>Сотрудники отдела {{$selectedDepartment->name}}</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ФИО</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Должность</th>
            <th scope="col">Тип работника</th>
            <th scope="col">Оплата за месяц</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{$employee->last_name}} {{$employee->first_name}} {{$employee->patronymic}}</td>
                <td>{{$employee->date_of_birth}}</td>
                <td>{{$employee->job_position}}</td>
                <td>{{$employee->getTypeName()}}</td>
                <td>{{$employee->getMonthlyPayment()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$employees->links()}}
@endsection

