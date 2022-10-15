<div>
    <h2>Tables:</h2>
    <form wire:submit.prevent="addTable" method="POST">
        <div class="mb-3">
            <label for="seats" class="form-label">Number of seats:</label>
            <input type="number" name="seats" class="form-control" aria-describedby="seats" wire:model="seats">
            @error('seats') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success mt-2">Add table</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Seats</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($restaurant->tables as $index => $table)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $table->seats }}</td>
                <td><a wire:click="deleteTable({{$table->id}})" type="button" class="btn btn-danger">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
