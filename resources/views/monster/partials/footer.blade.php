<footer class="footer">
    © 2018 Corus360
</footer>

@if(session('toastr')){
    {{ \Toastr::{session('toastr')}(session('message'), session('title'), $options = []) }}
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        {{ \Toastr::error($error, 'Error', $options = []) }}
    @endforeach
@endif
