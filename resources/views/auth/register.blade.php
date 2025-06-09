<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6" x-data="{ showFields: '{{ old('role', '') ?: 'student' }}' }">
        @csrf

        <!-- Role Selection -->
        <div>
            <x-input-label for="role" :value="__('Je suis*')" />
            <select id="role" name="role" required
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                x-on:change="showFields = $event.target.value">
                <option value="">Sélectionnez un rôle</option>
                @foreach($roles as $value => $label)
                    <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Common Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nom complet*')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email*')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Student Fields -->
        <div x-show="showFields === 'student'" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="student_number" :value="__('Numéro étudiant*')" />
                    <x-text-input id="student_number" type="text" name="student_number" :value="old('student_number')" required />
                    <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="first_name" :value="__('Prénom*')" />
                    <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="last_name" :value="__('Nom*')" />
                    <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="birth_date" :value="__('Date de naissance*')" />
                    <x-text-input id="birth_date" type="date" name="birth_date" :value="old('birth_date')" required />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="program" :value="__('Programme d\'études*')" />
                    <x-text-input id="program" type="text" name="program" :value="old('program')" required />
                    <x-input-error :messages="$errors->get('program')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="year_of_study" :value="__('Année d\'études*')" />
                    <x-text-input id="year_of_study" type="number" name="year_of_study" min="1" max="10" :value="old('year_of_study')" required />
                    <x-input-error :messages="$errors->get('year_of_study')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Teacher Fields -->
        <div x-show="showFields === 'teacher'" x-transition style="display: none;">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="first_name" :value="__('Prénom*')" />
                    <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="last_name" :value="__('Nom*')" />
                    <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="department" :value="__('Département*')" />
                    <x-text-input id="department" type="text" name="department" :value="old('department')" />
                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="specialization" :value="__('Spécialisation*')" />
                    <x-text-input id="specialization" type="text" name="specialization" :value="old('specialization')" />
                    <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Company Fields -->
        <div x-show="showFields === 'company'" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <x-input-label for="description" :value="__('Description de l\'entreprise*')" />
                    <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="siret" :value="__('SIRET*')" />
                    <x-text-input id="siret" type="text" name="siret" :value="old('siret')" placeholder="12345678901234" required />
                    <x-input-error :messages="$errors->get('siret')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="address" :value="__('Adresse*')" />
                    <x-text-input id="address" type="text" name="address" :value="old('address')" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="postal_code" :value="__('Code postal*')" />
                    <x-text-input id="postal_code" type="text" name="postal_code" :value="old('postal_code')" required />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="city" :value="__('Ville*')" />
                    <x-text-input id="city" type="text" name="city" :value="old('city')" required />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="country" :value="__('Pays*')" />
                    <x-text-input id="country" type="text" name="country" :value="old('country', 'France')" required />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Password Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Mot de passe*')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe*')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?' ) }}
            </a>

            <x-primary-button type="submit" class="ms-4">
                {{ __("S'inscrire") }}
            </x-primary-button>
        </div>
    </form>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('form', () => ({
                showFields: '{{ old('role', '') }}' || 'student',
                init() {
                    // Afficher les champs appropriés au chargement si erreur de validation
                    if (this.showFields) {
                        this.$nextTick(() => {
                            const roleSelect = document.getElementById('role');
                            if (roleSelect) {
                                roleSelect.dispatchEvent(new Event('change'));
                            }
                        });
                    }
                }
            }));
        });
    </script>
    @endpush
</x-guest-layout>
