import { createSelector } from 'reselect'
import { State } from './index'
import * as lifecycleStore from './lifecycle.store'
import * as chaptersStore from './chapters.store'

const root = {
  bootstrapped: (state: State) => state.lifecycle,
  chapters: (state: State) => state.chapters
}

const lifecycle = {
  bootstrapped: createSelector(root.bootstrapped, lifecycleStore.selectors.bootstrapped)
}

const chapters = {
  list: createSelector(root.chapters, chaptersStore.selectors.chapters)
}

export default { lifecycle, chapters }
