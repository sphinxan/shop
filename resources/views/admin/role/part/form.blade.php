@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Name"
           required maxlength="100" value="{{ old('name') ?? $role->name ?? '' }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
