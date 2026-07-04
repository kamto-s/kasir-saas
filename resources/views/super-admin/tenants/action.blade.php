<div class="gap-2 d-flex">
    <a href="{{ route('super-admin.tenants.edit', $row) }}" class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip"
        data-bs-placement="top" title="Edit">
        <i class="bx bx-edit"></i>
    </a>

    <a href="{{ route('super-admin.tenants.destroy', $row) }}" class="btn btn-outline-danger btn-sm"
        data-confirm-delete="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
        <i class="bx bx-trash"></i>
    </a>
</div>
