import { mount } from '@vue/test-utils'
import axios from 'axios'
import ClientsList from '@/components/ClientsList.vue'

jest.mock('axios')

describe('ClientsList.vue', () => {
  it('загружает и отображает список клиентов', async () => {
    axios.get.mockResolvedValue({
      data: [
        { id: 1, name: 'Иван Иванов', email: 'ivan@example.com' },
        { id: 2, name: 'Анна Петрова', email: 'anna@example.com' },
      ]
    })

    const wrapper = mount(ClientsList)

    // Дождёмся, пока fetchClients() выполнится и данные обновятся
    await wrapper.vm.fetchClients()
    await wrapper.vm.$nextTick()

    expect(wrapper.text()).toContain('Иван Иванов')
    expect(wrapper.text()).toContain('Анна Петрова')
  })
})
