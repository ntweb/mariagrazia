<ol class="breadcrumb">
    @foreach ($arrSteps as $k => $v)      
    <li><a href="#" @if($v) style="color: red;" @endif>{{trans('labels.'.$k)}}</a></li>
    @endforeach
</ol>