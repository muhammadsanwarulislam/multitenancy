<script setup>
	definePageMeta({ layout: 'guest' });
	const { isLoggedIn } = useAuth();
</script>

<template>
	<div class="relative min-h-screen bg-gray-100 white:bg-gray-900 w-full">
		<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
			<template v-if="isLoggedIn">
				<NuxtLink to="/dashboard" class="ml-4 text-sm text-gray-700 underline"> Dashboard </NuxtLink>
			</template>
			<template v-else>
				<NuxtLink to="/login" class="text-sm text-gray-700 underline"> Login </NuxtLink>
				<NuxtLink to="/register" class="ml-4 text-sm text-gray-700 underline"> Register </NuxtLink>
			</template>
		</div>

		<NuxtWelcome />
	</div>
</template>
