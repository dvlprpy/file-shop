@if (session('success'))
    
    <div class="alert alert-success d-flex flex-row justify-content-between me-2 ms-2" role="alert">
        <div class="d-flex flex-row justify-content-center">
            <i class="bi bi-check-square-fill"></i>
            <p class="ms-2 me-2">
                {{
                    session('success')
                }}
            </p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif



@if (session('userSuccessCreated'))
    
    <div class="alert alert-success d-flex flex-row justify-content-between me-2 ms-2" role="alert">
        <div class="d-flex flex-row justify-content-center">
            <i class="bi bi-check-square-fill"></i>
            <p class="ms-2 me-2">
                {{
                    session('success')
                }}
            </p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif