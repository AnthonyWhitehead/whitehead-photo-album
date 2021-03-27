import Photo from './components/photo'
import Home from './components/home'
import Navigation from './components/navigation'

export const routes = [
    {
        path: '/',
        components: {
            nav: Navigation,
            default: Home
        }
    },
    {
        path: '/photos/:id',
        component: Photo
    }
];
