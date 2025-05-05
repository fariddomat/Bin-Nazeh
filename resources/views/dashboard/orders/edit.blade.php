<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            @lang('site.edit') @lang('site.dashboard.orders')
        </h1>

        <form action="{{ route('dashboard.orders.update', $order->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.service_id')</label>
                <select name="service_id" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_service_id')</option>
                    @foreach ($services as $option)
                        <option value="{{ $option->id }}" {{ $order->service_id == $option->id ? 'selected' : '' }}>{{ $option->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.name')</label>
                <input type="text" name="name" value="{{ old('name', $order->name) }}" class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.email')</label>
                <input type="text" name="email" value="{{ old('email', $order->email) }}" class="w-full border border-gray-300 rounded p-2">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.phone')</label>
                <input type="text" name="phone" value="{{ old('phone', $order->phone) }}" class="w-full border border-gray-300 rounded p-2">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.project_type')</label>
                <input type="text" name="project_type" value="{{ old('project_type', $order->project_type) }}" class="w-full border border-gray-300 rounded p-2">
                @error('project_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.message')</label>
                <textarea name="message" class="w-full border border-gray-300 rounded p-2">{{ old('message', $order->message) }}</textarea>
                @error('message')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">@lang('site.status')</label>
                <select name="status" class="w-full border border-gray-300 rounded p-2">
                    <option value="">@lang('site.select_status')</option>
                    <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="processed" {{ old('status', $order->status) == 'processed' ? 'selected' : '' }}>processed</option>
                    <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>completed</option>

                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-700">
                @lang('site.update')
            </button>
        </form>
    </div>
</x-app-layout>