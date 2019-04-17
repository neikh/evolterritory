// Import the mount() method from the test utils
// and the component you want to test
import { mount } from '@vue/test-utils'
import PostPage from './resource/js/pages/Post'

describe('PostPage', () => {
  // Now mount the component and you have the wrapper
  const wrapper = mount(PostPage)

  it('switch button', () => {
      const buttonSwitsh = wrapper.find('button')

  })





  // it's also easy to check for the existence of elements
  // it('has a button', () => {
  //   expect(wrapper.contains('button')).toBe(true)
  // })
  //
  // it('button should increment the count', () => {
  //   expect(wrapper.vm.count).toBe(0)
  //   const button = wrapper.find('button')
  //   button.trigger('click')
  //   expect(wrapper.vm.count).toBe(1)
  // })
})
