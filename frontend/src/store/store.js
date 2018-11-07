import i18n from '@/plugins/i18n'

export default {
  toast: {
    text: '',
    show: false,
    timeout: 3000,
    bottom: true,
    top: false,
    right: true,
    left: false,
  },
  status: [
    {
      value: 1,
      text: i18n.tc('status.created')
    },
    {
      value: 2,
      text: i18n.tc('status.finished')
    },
    {
      value: 3,
      text: i18n.tc('status.canceled')
    }
  ]
};
