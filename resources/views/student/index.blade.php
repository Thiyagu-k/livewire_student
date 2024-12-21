@extends('layouts.app')

@section('content')
    <div>
        <livewire:student />
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('close-modal', event => {
            $('#studentModal').modal('hide');
            $('#updateStudentModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        })
    </script>
@endsection
