<template>
    <div class="border border-dark rounded-lg p-4">
        <div v-if="editor" class="flex flex-wrap">
            <tiptap-button @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
                <i class="fas fa-bold" />
            </tiptap-button>
            <tiptap-button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
                <i class="fas fa-italic" />
            </tiptap-button>
            <tiptap-button @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
                <i class="fas fa-strikethrough" />
            </tiptap-button>
            
            <tiptap-button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
                <i class="fas fa-paragraph" />
            </tiptap-button>
            <tiptap-button @click="editor.chain().focus().setHorizontalRule().run()" :class="{ 'is-active': editor.isActive('horizontalRule') }">_</tiptap-button>
            
            <tiptap-button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="['font-black', { 'is-active': editor.isActive('heading', { level: 1 }) }]">H1</tiptap-button>
            <tiptap-button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="['font-black', { 'is-active': editor.isActive('heading', { level: 2 }) }]">H2</tiptap-button>
            <tiptap-button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="['font-black', { 'is-active': editor.isActive('heading', { level: 3 }) }]">H3</tiptap-button>
            
            <tiptap-button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
                <i class="fas fa-list-ul" />
            </tiptap-button>
            <tiptap-button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
                <i class="fas fa-list-ol" />
            </tiptap-button>
            <tiptap-button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
                <i class="fas fa-quote-left" /><i class="fas fa-quote-right" />
            </tiptap-button>
            
            <tiptap-button @click="editor.chain().focus().undo().run()">
                <i class="fas fa-undo" />
            </tiptap-button>
            <tiptap-button @click="editor.chain().focus().redo().run()">
                <i class="fas fa-redo" />
            </tiptap-button>
            
            <tiptap-button @click="addImage">
                <i class="far fa-image" />
            </tiptap-button>
            
            <tiptap-button @click="editor.chain().focus().unsetAllMarks().run()" :class="'font-black'">clear marks</tiptap-button>
            <tiptap-button @click="editor.chain().focus().clearNodes().run()" :class="'font-black'">clear nodes</tiptap-button>
        </div>
        
        <div class="m-5">
            <editor-content :editor="editor" />
        </div>
    </div>
</template>

<script>
    import { Editor, EditorContent } from '@tiptap/vue-3'
    import Dropcursor from '@tiptap/extension-dropcursor'
    import Image from '@tiptap/extension-image'
    import StarterKit from '@tiptap/starter-kit'
    import TiptapButton from '@/Components/TiptapButton'

    export default {
        components: {
            EditorContent,
            TiptapButton,
        },

        props: {
            modelValue: {
                type: String,
                default: '',
            },
        },

        emits: ['input'],

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
        
        methods: {
            addImage() {
                const url = window.prompt('URL')

                if (url) {
                    this.editor.chain().focus().setImage({ src: url }).run()
                }
            },
        },

        mounted() {
            this.editor = new Editor({
                content: this.modelValue,
                extensions: [
                    Dropcursor,
                    Image,
                    StarterKit,
                ],
                editorProps: {
                    attributes: {
                        class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none',
                    },
                },
                content: ``,
                onUpdate: () => {
                    this.$emit('input', this.editor.getHTML());
                },
            });
            
            this.editor.commands.setContent(this.modelValue);
        },

        beforeUnmount() {
            this.editor.destroy();
        },
    }
</script>

<style scoped>
    img {
        max-width: 100%;
        height: auto;
    }
</style>