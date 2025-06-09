<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __(ucfirst($user->role) . ' Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your " . $user->role . " profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if($user->role === 'student')
            <!-- Champs pour les étudiants -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="first_name" :value="__('Prénom')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $profile->first_name ?? '')" autocomplete="given-name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Nom')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $profile->last_name ?? '')" autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Téléphone')" />
                    <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $profile->phone ?? '')" autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="birth_date" :value="__('Date de naissance')" />
                    <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $profile->birth_date ?? '')" />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="program" :value="__('Programme d\'études')" />
                    <x-text-input id="program" name="program" type="text" class="mt-1 block w-full" :value="old('program', $profile->program ?? '')" />
                    <x-input-error :messages="$errors->get('program')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="year_of_study" :value="__('Année d\'études')" />
                    <x-text-input id="year_of_study" name="year_of_study" type="number" min="1" max="5" class="mt-1 block w-full" :value="old('year_of_study', $profile->year_of_study ?? '')" />
                    <x-input-error :messages="$errors->get('year_of_study')" class="mt-2" />
                </div>
            </div>

            <div class="mt-4">
                <x-input-label for="address" :value="__('Adresse')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $profile->address ?? '')" autocomplete="street-address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <x-input-label for="postal_code" :value="__('Code postal')" />
                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $profile->postal_code ?? '')" autocomplete="postal-code" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="city" :value="__('Ville')" />
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $profile->city ?? '')" autocomplete="address-level2" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="country" :value="__('Pays')" />
                    <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $profile->country ?? 'France')" autocomplete="country-name" />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>

        @elseif($user->role === 'teacher')
            <!-- Champs pour les enseignants -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="first_name" :value="__('Prénom')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $profile->first_name ?? '')" autocomplete="given-name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Nom')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $profile->last_name ?? '')" autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Téléphone')" />
                    <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $profile->phone ?? '')" autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="office" :value="__('Bureau')" />
                    <x-text-input id="office" name="office" type="text" class="mt-1 block w-full" :value="old('office', $profile->office ?? '')" />
                    <x-input-error :messages="$errors->get('office')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="department" :value="__('Département')" />
                    <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', $profile->department ?? '')" />
                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="specialization" :value="__('Spécialisation')" />
                    <x-text-input id="specialization" name="specialization" type="text" class="mt-1 block w-full" :value="old('specialization', $profile->specialization ?? '')" />
                    <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
                </div>
            </div>

        @elseif($user->role === 'company')
            <!-- Champs pour les entreprises -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <x-input-label for="description" :value="__('Description de l\'entreprise')" />
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $profile->description ?? '') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="siret" :value="__('SIRET')" />
                    <x-text-input id="siret" name="siret" type="text" class="mt-1 block w-full" :value="old('siret', $profile->siret ?? '')" />
                    <x-input-error :messages="$errors->get('siret')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="naf_code" :value="__('Code NAF/APE')" />
                    <x-text-input id="naf_code" name="naf_code" type="text" class="mt-1 block w-full" :value="old('naf_code', $profile->naf_code ?? '')" />
                    <x-input-error :messages="$errors->get('naf_code')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="legal_status" :value="__('Forme juridique')" />
                    <x-text-input id="legal_status" name="legal_status" type="text" class="mt-1 block w-full" :value="old('legal_status', $profile->legal_status ?? '')" />
                    <x-input-error :messages="$errors->get('legal_status')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="website" :value="__('Site web')" />
                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="old('website', $profile->website ?? '')" />
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>
            </div>


            <div class="mt-4">
                <x-input-label for="address" :value="__('Adresse')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $profile->address ?? '')" autocomplete="street-address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <x-input-label for="postal_code" :value="__('Code postal')" />
                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $profile->postal_code ?? '')" autocomplete="postal-code" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="city" :value="__('Ville')" />
                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $profile->city ?? '')" autocomplete="address-level2" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="country" :value="__('Pays')" />
                    <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $profile->country ?? 'France')" autocomplete="country-name" />
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        @endif

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
