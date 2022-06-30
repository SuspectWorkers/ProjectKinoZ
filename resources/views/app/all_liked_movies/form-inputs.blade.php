@php $editing = isset($likedMovies) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="movies_id" label="Movies" required>
            @php $selected = old('movies_id', ($editing ? $likedMovies->movies_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Movies</option>
            @foreach($allMovies as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $likedMovies->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
