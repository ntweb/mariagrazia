@extends('lab.page.default')

@section('content')

    <h4 class="widgettitle">Table Bordered</h4>
    <table class="table table-striped responsive">
        <thead>
            <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Trident</td>
                <td>Internet Explorer 4.0</td>
                <td>Win 95+</td>
                <td class="center">4</td>
                <td class="center">X</td>
                <td class="right">
                    <div class="btn-group btn-group-xs">
                        <button href="javascript:void(0);" class="get-html btn btn-primary" data-route="{{action('Lab\PageController@edit', array(1))}}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></button>
                        <button href="javascript:void(0);" class="get-html btn btn-danger" data-route="{{action('Lab\PageController@edit', array(1))}}"><i class="fa fa-fw fa-trash" aria-hidden="true"></i></button>
                    </div>                                
                </td>
            </tr>
        </tbody>
    </table>

@endsection