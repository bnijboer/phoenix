<template>
    <form @submit.prevent="submit(form)">
        <div class="border border-dark rounded-lg p-4">
            <div v-if="editor">
                <button @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">bold</button>
                <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">italic</button>
                <button @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">strike</button>
                
                <button @click="editor.chain().focus().unsetAllMarks().run()">clear marks</button>
                <button @click="editor.chain().focus().clearNodes().run()">clear nodes</button>
                
                <button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">paragraph</button>
                <button @click="editor.chain().focus().setHorizontalRule().run()">horizontal rule</button>
                <button @click="editor.chain().focus().setHardBreak().run()">hard break</button>
                
                <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">h1</button>
                <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">h2</button>
                <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">h3</button>
                <button @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">h4</button>
                <button @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">h5</button>
                <button @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">h6</button>
                
                <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">bullet list</button>
                <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">ordered list</button>
                <button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">blockquote</button>
                
                <button @click="editor.chain().focus().undo().run()">undo</button>
                <button @click="editor.chain().focus().redo().run()">redo</button>
            </div>
            
            <editor-content :editor="editor" />
        </div>
        

        <div class="flex justify-between mt-10">
            <back-link />

            <submit-button>Aanmaken</submit-button>
        </div>
    </form>
</template>

<script>
    import { Editor, EditorContent } from '@tiptap/vue-3'
    import BackLink from '@/Components/BackLink.vue';
    import StarterKit from '@tiptap/starter-kit'
    import SubmitButton from '@/Components/Button';

    export default {
        components: {
            BackLink,
            EditorContent,
            SubmitButton,
        },

        props: {
            modelValue: {
                type: String,
                default: '',
            },
        },

        data() {
            return {
                editor: null,
            }
        },
        
        watch: {
            modelValue(value) {
                const isSame = this.editor.getHTML() === value;

                if (isSame) {
                    return;
                }

                this.editor.commands.setContent(this.modelValue, false);
            },
        },

        mounted() {
            this.editor = new Editor({
                content: this.modelValue,
                extensions: [
                    StarterKit
                ],
                editorProps: {
                    attributes: {
                        class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none',
                    },
                },
                content: `
                    <p>Hi there!</p>
                `,
                onUpdate: () => {
                    this.$emit('update:modelValue', this.editor.getHTML())
                },
            });
        },

        beforeDestroy() {
            this.editor.destroy();
        },

        methods: {
            submit(form) {
                // form.post(route('posts.store'), form);
                console.log(this.editor.getHTML());
            },
        },
    }
</script>