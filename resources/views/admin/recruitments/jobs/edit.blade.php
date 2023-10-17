@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-4">Edit Job</h1>

            <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="max-w-md">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ $job->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="branch" class="block text-gray-700 text-sm font-bold mb-2">Branch</label>
                    <select name="branch" id="branch" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option disabled>Select Branch</option>
                        <option value="All Branch" {{ $job->branch === 'All Branch' ? 'selected' : '' }}>All Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->name }}" {{ $job->branch === $branch->name ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="job_category_id" class="block text-gray-700 text-sm font-bold mb-2">Job Category</label>
                    <select name="job_category_id" id="job_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option disabled>Select Job Category</option>
                        @foreach($jobCategories as $category)
                            <option value="{{ $category->id }}" {{ $job->job_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="number_of_positions" class="block text-gray-700 text-sm font-bold mb-2">Number of Positions</label>
                    <input type="number" name="number_of_positions" id="number_of_positions" value="{{ $job->number_of_positions }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option disabled>Select Status</option>
                        <option value="Active" {{ $job->status === 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $job->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $job->start_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $job->end_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="skills" class="block text-gray-700 text-sm font-bold mb-2">Skills (Press Tab after typing a skill)</label>
                    <textarea name="skills" id="skills" rows="3" class="autocomplete-skill shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $job->skills }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender</label>
                    <select name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option disabled>Select Gender</option>
                        <option value="Male" {{ $job->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $job->gender === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ $job->gender === 'Other' ? 'selected' : '' }}>Both</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dob_required" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth Required</label>
                    <select name="dob_required" id="dob_required" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="1" {{ $job->dob_required == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $job->dob_required == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="address_required" class="block text-gray-700 text-sm font-bold mb-2">Address Required</label>
                    <select name="address_required" id="address_required" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="1" {{ $job->address_required == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $job->address_required == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="profile_image_required" class="block text-gray-700 text-sm font-bold mb-2">Profile Image Required</label>
                    <select name="profile_image_required" id="profile_image_required" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="1" {{ $job->profile_image_required == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $job->profile_image_required == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="resume_required" class="block text-gray-700 text-sm font-bold mb-2">Resume Required</label>
                    <select name="resume_required" id="resume_required" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="1" {{ $job->resume_required == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $job->resume_required == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="cover_letter_required" class="block text-gray-700 text-sm font-bold mb-2">Cover Letter Required</label>
                    <select name="cover_letter_required" id="cover_letter_required" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="1" {{ $job->cover_letter_required == 1 ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ $job->cover_letter_required == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $job->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="requirements" class="block text-gray-700 text-sm font-bold mb-2">Requirements</label>
                    <textarea name="requirements" id="requirements" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $job->requirements }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                    <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                </div>
            </form>
        </div>
        @if ($errors->any())
        <div class="mt-4">
            <div class="text-red-500 text-sm">
                Please correct the following errors:
            </div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>

    <script>
        const skillInput = document.getElementById('skills');
        const tagContainer = document.getElementById('tag-container');
        const skillsHiddenInput = document.getElementById('skills-hidden');

        // Function to update the hidden input with skills data
        const updateSkillsHiddenInput = () => {
            const tags = tagContainer.querySelectorAll('.tag');
            const skills = Array.from(tags).map(tag => tag.textContent).join(', ');
            skillsHiddenInput.value = skills;
        };

        // Override space key behavior for skills textarea
        skillInput.addEventListener('keydown', function (e) {
            if (e.code === 'Tab') { // Space key pressed
                e.preventDefault(); // Prevent default space behavior
                const currentCursorPosition = skillInput.selectionStart;
                const skillsArray = skillInput.value.split(' ');
                const tag = skillsArray.pop(); // Extract the last word as a tag

                if (tag && tag.trim() !== '') {
                    const tagElement = document.createElement('span');
                    tagElement.classList.add('tag');
                    tagElement.textContent = tag;

                    tagContainer.appendChild(tagElement);
                    skillInput.value = skillsArray.join(' ') + ' ';
                    updateSkillsHiddenInput(); // Update the hidden input with skills data
                }

                skillInput.selectionStart = skillInput.selectionEnd = currentCursorPosition + 1;
            }
        });

        // Update the hidden input whenever a tag is added or removed
        tagContainer.addEventListener('DOMSubtreeModified', updateSkillsHiddenInput);
    </script>
@endsection
