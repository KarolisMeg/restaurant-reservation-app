<div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <h2>Add restaurant</h2>
                <form wire:submit.prevent="addRestaurant" method="POST">
                    <div class="mb-3">
                        <label for="restaurantTitle" class="form-label">Restaurant title:</label>
                        <input type="text" name="restaurantTitle" class="form-control" aria-describedby="surname" wire:model="restaurantTitle">
                        @error('restaurantTitle') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="opensAt" class="form-label">Opens at:</label>
                        <input type="time" name="opensAt" class="form-control" aria-describedby="opensAt" wire:model="opensAt">
                        @error('opensAt') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="closesAt" class="form-label">Opens at:</label>
                        <input type="time" name="closesAt" class="form-control" aria-describedby="closesAt" wire:model="closesAt">
                        @error('closesAt') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Add restaurant</button>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Tables count</th>
                        <th scope="col">Restaurant capacity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($restaurants as $index => $restaurant)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $restaurant->title }}</td>
                            <td>{{ $restaurant->tables()->count() }}</td>
                            <td>{{ $restaurant->tables()->sum('seats') }}</td>
                            <td>
                                <button wire:click="showRestaurant({{$restaurant->id}})" class="btn btn-primary">Details</button>
                                <button wire:click="deleteRestaurant({{$restaurant->id}})" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
