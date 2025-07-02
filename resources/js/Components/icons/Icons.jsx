// resources/js/Components/icons/Icons.js
import { h } from 'vue';

export const UsersIcon = {
  name: 'UsersIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a4 4 0 11-8 0 4 4 0 018 0z'
      })
    ]);
  }
};

export const TagIcon = {
  name: 'TagIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'
      })
    ]);
  }
};

export const KeyIcon = {
  name: 'KeyIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'
      })
    ]);
  }
};

export const CollectionIcon = {
  name: 'CollectionIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
      })
    ]);
  }
};

export const UserGroupIcon = {
  name: 'UserGroupIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
      })
    ]);
  }
};

export const CashIcon = {
  name: 'CashIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
      })
    ]);
  }
};

export const CreditCardIcon = {
  name: 'CreditCardIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'
      })
    ]);
  }
};

export const ChartBarIcon = {
  name: 'ChartBarIcon',
  render() {
    return h('svg', {
      class: 'w-5 h-5',
      fill: 'none',
      stroke: 'currentColor',
      viewBox: '0 0 24 24',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round',
        'stroke-width': '2',
        d: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'
      })
    ]);
  }
};

export default {
  UsersIcon,
  TagIcon,
  KeyIcon,
  CollectionIcon,
  UserGroupIcon,
  CashIcon,
  CreditCardIcon,
  ChartBarIcon
};