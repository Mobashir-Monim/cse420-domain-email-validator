<div class="row">
    <div class="col-md-6">
        {{ $entity->value }}
    </div>
    <div class="col-md-6">
        {{ $entity->validity ? "Valid" : "Invalid" }}
    </div>
</div>