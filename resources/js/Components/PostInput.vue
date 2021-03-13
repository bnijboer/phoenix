<template>
    <form-label :for="field" />
                
    <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
            :id="field"
            :type="inputType"
            :value="modelValue"
            :placeholder="placeholder"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input" />
                
    <validation-error :message="message" />
</template>

<script>
    import FormLabel from '@/Components/Label'
    import ValidationError from '@/Components/InputError'
    
    export default {
        components: {
            FormLabel,
            ValidationError,
        },
        
        props: ['field', 'inputType', 'message', 'modelValue', 'placeholder'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>
