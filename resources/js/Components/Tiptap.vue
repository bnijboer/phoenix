<template>
    <div class="border border-dark rounded-lg p-4">
        <div v-if="editor">
            <button type="button" @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }"><i class="fas fa-bold" /></button>
            <button type="button" @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }"><i class="fas fa-italic" /></button>
            <button type="button" @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }"><i class="fas fa-strikethrough" /></button>
            
            <button type="button" @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }"><i class="fas fa-paragraph" /></button>
            <button type="button" @click="editor.chain().focus().setHorizontalRule().run()">_</button>
            <!-- <button type="button" @click="editor.chain().focus().setHardBreak().run()">hard break</button> -->
            
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">H1</button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">H2</button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">H3</button>
            
            <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }"><i class="fas fa-list-ul" /></button>
            <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }"><i class="fas fa-list-ol" /></button>
            <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }"><i class="fas fa-quote-left" /><i class="fas fa-quote-right" /></button>
            
            <button type="button" @click="editor.chain().focus().undo().run()"><i class="fas fa-undo" /></button>
            <button type="button" @click="editor.chain().focus().redo().run()"><i class="fas fa-redo" /></button>
            
            <button type="button" @click="addImage"><i class="far fa-image" /></button>
            
            <button type="button" @click="editor.chain().focus().unsetAllMarks().run()">clear marks</button>
            <button type="button" @click="editor.chain().focus().clearNodes().run()">clear nodes</button>
        </div>
        
        <editor-content :editor="editor" />
    </div>
</template>

<script>
    import { Editor, EditorContent } from '@tiptap/vue-3'
    import Dropcursor from '@tiptap/extension-dropcursor'
    import Image from '@tiptap/extension-image'
    import StarterKit from '@tiptap/starter-kit'

    export default {
        components: {
            EditorContent,
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
                content: `
                    <p>This is a basic example of implementing images. Drag to re-order.</p>
                    <img src="https://source.unsplash.com/8xznAGy4HcY/800x400" />
                    <img src="https://source.unsplash.com/K9QHL52rE2k/800x400" />
                `,
                // onUpdate: () => {
                //     this.$emit('update:modelValue', this.editor.getHTML())
                // },
            });
        },

        beforeDestroy() {
            this.editor.destroy();
        },
    }
</script>

<style scoped>
    i {
        margin: 5px;
    }
    
    img {
        max-width: 100%;
        height: auto;
    }
</style>