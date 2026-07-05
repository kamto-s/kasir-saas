<div class="gap-2 d-flex">
    <a href="{{ route('super-admin.branches.edit', $row) }}" class="btn btn-outline-warning btn-sm">
        <i class="bx bx-edit"></i>
    </a>

    <a href="{{ route('super-admin.branches.destroy', $row) }}" class="btn btn-outline-danger btn-sm"
        data-confirm-delete="true">
        <i class="bx bx-trash"></i>
    </a>
</div>
