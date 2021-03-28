import Photo from './components/photo'
import Home from './components/home'
import Navigation from './components/navigation'
import Upload from './components/upload'

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
    },
    {
        path: '/upload',
        name: 'upload',
        components: {
            nav: Navigation,
            default: Upload
        }
    }
];
