import React, { Component } from 'react'
import Editor from 'react-editor'

class Page extends Component {

  onFocus() {
    this.refs.editor.restoreRange()
  }
  onBlur() {
    const { editor } = this.refs
    editor.lint()
    editor.saveRange()
    editor.clearRange()
  }

  render() {
    return (
      <div onFocus={(e) => this.onFocus(e)}
        onBlur={(e) => this.onBlur(e)}>
        <Editor ref="editor" className={styles.editor}
          dangerouslySetInnerHTML={{__html: html}} />
      </div>
    )
  }
}