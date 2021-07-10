<template>
    <div v-if="$page.props.flash.success" class="flash flash-success">
        {{ $page.props.flash.success }}
    </div>
    <div v-if="$page.props.flash.error" class="flash flash-error">
        {{ $page.props.flash.error }}
    </div>
</template>