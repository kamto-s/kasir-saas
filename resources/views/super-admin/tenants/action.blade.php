<div class="gap-2 d-flex">
    <a href="{{ route('super-admin.tenants.edit', $row) }}" class="btn btn-warning btn-sm">
        <i class="bx bx-edit"></i>
    </a>

    <a href="{{ route('super-admin.tenants.destroy', $row) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">
        <i class="bx bx-trash"></i>
    </a>
</div>
