import React from 'react';
import AppLogo from '../../swansea-university-logo.svg';
export default function ApplicationLogo({ className }) {
    return (
        <div className={className}>
            <img src={AppLogo} />
        </div>
    );
}
