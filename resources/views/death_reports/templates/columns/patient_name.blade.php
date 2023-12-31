@if(getLoggedInUser()->hasRole('Nurse'))
    <div class="d-flex align-items-center">
        <div class="image image-mini me-3">
            <img src="{{$row->patient->patientUser->image_url}}" alt="user"
                 class="user-img image rounded-circle object-contain">
        </div>
        <div class="d-flex flex-column">
            {{$row->patient->patientUser->full_name}}
            <span class="fs-6">{{$row->patient->patientUser->email}}</span>
        </div>
    </div>
@else
    <div class="d-flex align-items-center">
        <div class="image image-mini me-3">
            <a href="{{route('patients.show', $row->patient->id)}}">
                <img src="{{$row->patient->patientUser->image_url}}" alt="user"
                     class="user-img image rounded-circle object-contain">
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="{{route('patients.show', $row->patient->id)}}" class="mb-1 text-decoration-none fs-6">
                {{$row->patient->patientUser->full_name}}
            </a>
            <span class="fs-6">{{$row->patient->patientUser->email}}</span>
        </div>
    </div>
@endif
